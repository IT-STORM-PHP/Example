<!DOCTYPE html>
<html>
<head>
    <title>Détails de la tâche</title>
</head>
<body>
    <p>
        Titre : <strong><?= htmlspecialchars($task['title'] ?? 'Aucun titre ajouté') ?></strong>
    </p>
    
    <p>
        Description : <?= htmlspecialchars($task['description'] ?? 'Aucune description pour le moment') ?>
    </p>
    <p>
        Status :
        <?php
            if ($task['status'] == 0){
                echo "En cours";
            } else {
                echo "Achevée";
            }
        ?>
    </p>
    <a href="/POO/task-manager/public/tasks">Retour</a>
</body>
</html>
