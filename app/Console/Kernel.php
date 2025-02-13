<?php

namespace App\Console;

use PDO;
use App\Models\Database;

class Kernel
{
    protected array $commands = [
        'serve' => 'serve',
        'make:migrations' => 'makeMigration',
        'migrate' => 'migrate',
        'rollback' => 'rollback',
        'make:crud' => 'makeCrud',
        'make:controllers' => 'makeController',

    ];

    public function handle($argv)
    {
        $command = $argv[1] ?? null;
        $argument = $argv[2] ?? null;

        if (!$command || !isset($this->commands[$command])) {
            $this->showUsage();
            exit(1);
        }

        $method = $this->commands[$command];
        $this->$method($argument);
    }

    protected function serve()
    {
        $port = 8000;
        while (@fsockopen('127.0.0.1', $port)) {
            $port++;
        }
        echo "Démarrage du serveur local sur http://127.0.0.1:$port\n";
        exec("php -S 127.0.0.1:$port -t public");
    }

    protected function makeMigration($name)
    {
        if (!$name) {
            echo "❌ Veuillez fournir un nom de migration.\n";
            exit(1);
        }

        // Utilisation du nom directement sans datation
        $filename = "database/migrations/{$name}.php";
        $classname = ucfirst($name);

        // Contenu de la migration
        $content = "<?php\n\nnamespace Database\Migrations;\n\nuse App\Schema\Blueprint;\nuse App\Database\Migration;\n\nclass {$classname} extends Migration\n{\n";
        $content .= "    public function up()\n    {\n";
        $content .= "        \$table = new Blueprint('table_name');\n";
        $content .= "        \$table->id();\n";
        $content .= "        \$table->string('name');\n";
        $content .= "        \$table->timestamps();\n";
        $content .= "        \$this->executeSQL(\$table->getSQL());\n";
        $content .= "    }\n\n";
        $content .= "    public function down()\n    {\n";
        $content .= "        \$table = new Blueprint('table_name');\n";
        $content .= "        \$this->executeSQL(\$table->dropSQL());\n";
        $content .= "    }\n}\n";

        // Vérifier si le dossier de migration existe
        if (!is_dir('database/migrations')) {
            mkdir('database/migrations', 0777, true);
        }

        // Créer le fichier de migration et y écrire le contenu
        file_put_contents($filename, $content);
        echo "✅ Migration créée : $filename\n";
    }

    protected function migrate()
    {
        echo "🚀 Exécution des migrations...\n";

        // Vérifier si la table 'migrations' existe
        $this->checkMigrationsTable();

        // Récupérer tous les fichiers de migration dans le dossier 'migrations'
        $files = glob(__DIR__ . '/../../database/migrations/*.php');
        sort($files); // Trie les fichiers de migration

        // Récupérer les migrations déjà appliquées
        $appliedMigrations = $this->getAppliedMigrations();

        foreach ($files as $file) {
            $migrationName = pathinfo($file, PATHINFO_FILENAME);

            // Vérifier si la migration a déjà été appliquée
            if (in_array($migrationName, $appliedMigrations)) {
                echo "✅ Migration déjà appliquée : $migrationName\n";
                continue; // Passer à la suivante
            }

            require_once $file;

            // Extraire le nom de la classe
            $className = 'Database\\Migrations\\' . preg_replace('/^\d+_\d+_\d+_\d+_\d+_\d+_/', '', $migrationName);

            if (class_exists($className)) {
                $migration = new $className();
                try {
                    echo "🔧 Exécution de la migration : $className\n";
                    $migration->up();
                    $this->recordMigration($migrationName); // Enregistrer la migration dans la table
                    echo "✅ Migration réussie : $className\n";
                } catch (\Exception $e) {
                    echo "❌ Erreur lors de l'exécution de la migration : " . $e->getMessage() . "\n";
                }
            } else {
                echo "❌ Erreur : La classe '$className' n'existe pas dans le fichier '$file'.\n";
            }
        }

        echo "✅ Toutes les migrations exécutées.\n";
    }

    // Méthode pour vérifier si la table 'migrations' existe, sinon la créer
    private function checkMigrationsTable()
    {
        $pdo = \App\Models\Database::getInstance()->getConnection();

        // Vérifier si la table 'migrations' existe
        $stmt = $pdo->query("SHOW TABLES LIKE 'migrations'");
        if ($stmt->rowCount() === 0) {
            // Si la table n'existe pas, on la crée
            $createTableSQL = "
            CREATE TABLE migrations (
                id INT AUTO_INCREMENT PRIMARY KEY,
                migration_name VARCHAR(255) NOT NULL,
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
            )";
            $pdo->exec($createTableSQL);
            echo "✅ Table 'migrations' créée.\n";
        }
    }

    private function getAppliedMigrations()
    {
        // Utiliser la classe Database pour obtenir la connexion
        $pdo = \App\Models\Database::getInstance()->getConnection();

        $query = "SELECT migration_name FROM migrations";
        $stmt = $pdo->query($query);
        return $stmt->fetchAll(PDO::FETCH_COLUMN);
    }

    private function recordMigration($migrationName)
    {
        // Utiliser la classe Database pour obtenir la connexion
        $pdo = \App\Models\Database::getInstance()->getConnection();

        // Enregistrer la migration dans la table 'migrations'
        $query = "INSERT INTO migrations (migration_name) VALUES (:migration_name)";
        $stmt = $pdo->prepare($query);
        $stmt->execute(['migration_name' => $migrationName]);
    }

    protected function rollback()
    {
        echo "⏪ Annulation des dernières migrations...\n";
        $files = glob(__DIR__ . '/../../database/migrations/*.php');
        rsort($files); // Exécute les rollbacks en ordre inverse

        foreach ($files as $file) {
            require_once $file;
            $className = 'Database\\Migrations\\' . pathinfo($file, PATHINFO_FILENAME);
            if (class_exists($className)) {
                $migration = new $className();
                echo "🔄 Rollback : " . $className . "\n";
                $migration->down();
            }
        }
        echo "✅ Rollback terminé.\n";
    }

    protected function makeCrud($model)
{
    if (!$model) {
        echo "❌ Veuillez fournir un nom pour le modèle.\n";
        return;
    }

    // Mettre la première lettre en majuscule
    $model = ucfirst($model);

    // 1. Vérifier si la migration existe pour ce modèle
    $pdo = \App\Models\Database::getInstance()->getConnection();
    $stmt = $pdo->prepare("SELECT * FROM migrations WHERE migration_name = :model");
    $stmt->execute(['model' => strtolower($model)]); // Comparaison en minuscule

    if ($stmt->rowCount() === 0) {
        echo "❌ Aucune migration trouvée pour le modèle '$model'.\n";
        return;
    }

    // 2. Récupérer la structure de la table
    $stmt = $pdo->prepare("DESCRIBE " . strtolower($model));
    $stmt->execute();
    $columns = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // 3. Générer le modèle
    $modelContent = "<?php\n\nnamespace App\Models;\n\n";
    $modelContent .= "use PDO;\n";
    $modelContent .= "use App\Models\Model;\n\n";
    $modelContent .= "class {$model} extends Model\n{\n";

    // Ajouter les attributs du modèle
    foreach ($columns as $column) {
        $modelContent .= "    public \${$column['Field']};\n";
    }

    // Méthode Create
    $modelContent .= "\n    public function create(\$data)\n    {\n";
    $modelContent .= "        \$pdo = \App\Models\Database::getInstance()->getConnection();\n";
    $modelContent .= "        \$sql = \"INSERT INTO " . strtolower($model) . " (" . implode(", ", array_column($columns, 'Field')) . ") VALUES (:" . implode(", :", array_column($columns, 'Field')) . ")\";\n";
    $modelContent .= "        \$stmt = \$pdo->prepare(\$sql);\n";
    foreach ($columns as $column) {
        $modelContent .= "        \$stmt->bindParam(':{$column['Field']}', \$data['{$column['Field']}']);\n";
    }
    $modelContent .= "        return \$stmt->execute();\n";
    $modelContent .= "    }\n";

    // Méthode Read (find by id)
    $modelContent .= "\n    public static function read(\$id)\n    {\n";
    $modelContent .= "        \$pdo = \App\Models\Database::getInstance()->getConnection();\n";
    $modelContent .= "        \$sql = \"SELECT * FROM " . strtolower($model) . " WHERE id = :id\";\n";
    $modelContent .= "        \$stmt = \$pdo->prepare(\$sql);\n";
    $modelContent .= "        \$stmt->bindParam(':id', \$id);\n";
    $modelContent .= "        \$stmt->execute();\n";
    $modelContent .= "        return \$stmt->fetch(PDO::FETCH_ASSOC);\n";
    $modelContent .= "    }\n";

    // Méthode Update
    $modelContent .= "\n    public function update(\$id, \$data)\n    {\n";
    $modelContent .= "        \$pdo = \App\Models\Database::getInstance()->getConnection();\n";
    $modelContent .= "        \$sql = \"UPDATE " . strtolower($model) . " SET ";
    $modelContent .= implode(", ", array_map(fn($col) => "{$col['Field']} = :{$col['Field']}", $columns));
    $modelContent .= " WHERE id = :id\";\n";
    $modelContent .= "        \$stmt = \$pdo->prepare(\$sql);\n";
    foreach ($columns as $column) {
        $modelContent .= "        \$stmt->bindParam(':{$column['Field']}', \$data['{$column['Field']}']);\n";
    }
    $modelContent .= "        \$stmt->bindParam(':id', \$id);\n";
    $modelContent .= "        return \$stmt->execute();\n";
    $modelContent .= "    }\n";

    // Méthode Delete
    $modelContent .= "\n    public function delete(\$id)\n    {\n";
    $modelContent .= "        \$pdo = \App\Models\Database::getInstance()->getConnection();\n";
    $modelContent .= "        \$sql = \"DELETE FROM " . strtolower($model) . " WHERE id = :id\";\n";
    $modelContent .= "        \$stmt = \$pdo->prepare(\$sql);\n";
    $modelContent .= "        \$stmt->bindParam(':id', \$id);\n";
    $modelContent .= "        return \$stmt->execute();\n";
    $modelContent .= "    }\n";

    // Fermer la classe
    $modelContent .= "}\n";

    // Créer le fichier du modèle
    file_put_contents("app/Models/{$model}.php", $modelContent);
    echo "✅ Modèle '$model' avec méthodes CRUD créé.\n";
}



protected function makeController($controllerName)
{
    if (!$controllerName) {
        echo "❌ Veuillez fournir un nom pour le contrôleur.\n";
        exit(1);
    }

    // Mettre la première lettre en majuscule
    $controllerName = ucfirst($controllerName);

    // Chemin du fichier
    $filePath = "app/Controllers/{$controllerName}.php";

    // Vérifier si le contrôleur existe déjà
    if (file_exists($filePath)) {
        echo "❌ Le contrôleur '$controllerName' existe déjà.\n";
        exit(1);
    }

    // Contenu du contrôleur
    $content = "<?php\n\nnamespace App\Controllers;\n\n";
    $content .= "use App\Controller\Controllers;\n\n";
    $content .= "class {$controllerName} extends Controller\n{\n";
    $content .= "    public function index()\n    {\n";
    $content .= "        // Action par défaut\n";
    $content .= "        echo 'Hello from {$controllerName} Controller';\n";
    $content .= "    }\n";
    $content .= "}\n";

    // Créer le fichier du contrôleur
    file_put_contents($filePath, $content);

    echo "✅ Contrôleur '$controllerName' créé dans 'app/Controllers'.\n";
}



    protected function showUsage()
    {
        echo "Usage: php storm <commande>\n";
        echo "Commandes disponibles :\n";
        echo "  serve             Démarrer le serveur local\n";
        echo "  make:migrations   Créer un fichier de migration\n";
        echo "  migrate           Exécuter les migrations\n";
        echo "  rollback          Annuler la dernière migration\n";
        echo '  make:crud         Créer un modèle et un contrôleur CRUD pour une table existante' . "\n";
        echo '  make:controllers  Créer un contrôleur' . "\n";
    }
}
