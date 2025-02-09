<?php
namespace Tests\Controllers;

use PHPUnit\Framework\TestCase;
use App\Models\Database;
use App\Controllers\TaskController;

class TaskControllerTest extends TestCase
{
    protected $controller;
    protected $db;

    protected function setUp(): void
    {
        // Configurer l'environnement de test
        putenv('ENV=test');

        // Initialiser la connexion SQLite en mémoire
        Database::getInstance(); // La connexion sera en mémoire

        // Créer l'instance du contrôleur
        $this->controller = new TaskController();
    }

    public function testIndex()
    {
        // Insérer des données pour tester
        $sql = "INSERT INTO tasks (title, description) VALUES ('Test Task', 'Test Description')";
        Database::getInstance()->getConnection()->exec($sql);

        // Tester la récupération des tâches
        $tasks = $this->controller->index();

        // Vérifier que la tâche a été ajoutée
        $this->assertCount(1, $tasks);
        $this->assertEquals('Test Task', $tasks[0]['title']);
    }

    public function testShow()
    {
        // Insérer une tâche pour tester
        $sql = "INSERT INTO tasks (title, description) VALUES ('Test Task', 'Test Description')";
        Database::getInstance()->getConnection()->exec($sql);

        // Récupérer l'ID de la tâche
        $taskId = Database::getInstance()->getConnection()->lastInsertId();

        // Tester la méthode show
        $task = $this->controller->show($taskId);

        // Vérifier que la tâche récupérée est correcte
        $this->assertEquals('Test Task', $task['title']);
        $this->assertEquals('Test Description', $task['description']);
    }

    public function testCreate()
    {
        // Tester la méthode create
        $_POST['title'] = 'New Task';
        $_POST['description'] = 'New Task Description';

        $this->controller->create(); // Appel à la méthode create de TaskController

        // Vérifier que la tâche a bien été ajoutée à la base
        $stmt = Database::getInstance()->getConnection()->query("SELECT * FROM tasks WHERE title = 'New Task'");
        $task = $stmt->fetch();

        $this->assertNotNull($task);
        $this->assertEquals('New Task', $task['title']);
        $this->assertEquals('New Task Description', $task['description']);
    }

    public function testUpdate()
    {
        // Insérer une tâche existante
        $sql = "INSERT INTO tasks (title, description) VALUES ('Old Task', 'Old Description')";
        Database::getInstance()->getConnection()->exec($sql);

        $taskId = Database::getInstance()->getConnection()->lastInsertId();

        // Tester la mise à jour
        $_POST['title'] = 'Updated Task';
        $_POST['description'] = 'Updated Description';

        $this->controller->update($taskId);

        // Vérifier que la tâche a bien été mise à jour
        $stmt = Database::getInstance()->getConnection()->query("SELECT * FROM tasks WHERE id = $taskId");
        $task = $stmt->fetch();

        $this->assertEquals('Updated Task', $task['title']);
        $this->assertEquals('Updated Description', $task['description']);
    }

    public function testDestroy()
    {
        // Insérer une tâche existante
        $sql = "INSERT INTO tasks (title, description) VALUES ('Task to Delete', 'Description')";
        Database::getInstance()->getConnection()->exec($sql);

        $taskId = Database::getInstance()->getConnection()->lastInsertId();

        // Tester la suppression
        $this->controller->destroy($taskId);

        // Vérifier que la tâche a été supprimée
        $stmt = Database::getInstance()->getConnection()->query("SELECT * FROM tasks WHERE id = $taskId");
        $task = $stmt->fetch();

        $this->assertFalse($task);  // Aucune tâche ne devrait être trouvée
    }
}
?>