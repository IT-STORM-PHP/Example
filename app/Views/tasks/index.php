<!DOCTYPE html>
<html>
<head>
    <title>Liste des tâches</title>
</head>
<body>
    <h1>Liste des tâches</h1>
    <a href="/POO/task-manager/public/tasks/create">Ajouter une tâche</a>
    
    <!-- Tableau pour afficher les tâches -->
    <table border="1" cellspacing="0" cellpadding="0">
        <thead>
            <tr>
                <th>Titre</th>
                <th>Description</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($tasks as $task): ?>
                <tr>
                    <td><?= htmlspecialchars($task['title']) ?></td>
                    <td><?= htmlspecialchars($task['description']) ?></td>
                    <td>
                        <a href="/POO/task-manager/public/tasks/<?= $task['id'] ?>">Voir</a> | 
                        <a href="/POO/task-manager/public/tasks/<?= $task['id'] ?>/edit">Modifier</a> | 
                        <form action="/POO/task-manager/public/tasks/<?= $task['id'] ?>/delete" method="POST" style="display:inline;">
                            <button type="submit">Supprimer</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>
