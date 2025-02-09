<!DOCTYPE html>
<html>
<head>
    <title>Créer une tâche</title>
</head>
<body>
    <h1>Créer une nouvelle tâche</h1>
    <form action="/POO/task-manager/public/tasks/store" method="POST">
        <label>Titre :</label>
        <input type="text" name="title" required>
        <label>Description :</label>
        <textarea name="description" required></textarea>
        <button type="submit">Créer</button>
    </form>
</body>
</html>
