<!DOCTYPE html>
<html>
<head>
    <title>Liste des tâches</title>
</head>
<body>
    <h1>Liste des tâches</h1>
    <a href="/task/create">Ajouter une tâche</a>
    
    <!-- Tableau pour afficher les tâches -->
    <table border="1" cellspacing="0" cellpadding="0">
        <thead>
            <tr>
                <th>Titre</th>
                <th>Description</th>
                <th>Status</th>
                <th>Ajouté le</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($tasks as $task): ?>
                <tr>
                    <td><?= htmlspecialchars($task['title']) ?></td>
                    <td><?= htmlspecialchars($task['description']) ?></td>
                    <td> 
                        <?php
                            if ($task["status"] == 0){
                                echo "En cours";
                            }else {
                                echo "Terminée";
                            }
                        ?>
                    </td>
                    <td><?= htmlspecialchars($task['created_at']) ?></td>
                    <td>
                        <a href="/task/<?= $task['id'] ?>">Voir</a> | 
                        <a href="/task/<?= $task['id'] ?>/edit">Modifier</a> | 
                        <form action="/task/<?= $task['id'] ?>/delete" method="POST" style="display:inline;">
                            <button type="submit">Supprimer</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>
