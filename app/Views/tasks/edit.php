<!DOCTYPE html>
<html>
<head>
    <title>Modifier une tâche</title>
</head>
<body>
    <h1>Modifier la tâche</h1>
    <form action="/POO/task-manager/public/tasks/<?= $task['id'] ?>" method="POST">
        <label>Titre :</label>
        <input type="text" name="title" value="<?= htmlspecialchars($task['title']) ?>" required>
        <label>Description :</label>
        <textarea name="description" required><?= htmlspecialchars($task['description']) ?></textarea>
        <button type="submit">Mettre à jour</button>
    </form>
</body>
</html>
