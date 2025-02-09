<!DOCTYPE html>
<html>
<head>
    <title>Détails de la tâche</title>
</head>
<body>
    <h1><?= htmlspecialchars($task['title'] ?? 'Aucun titre ajouté') ?></h1>
    <p><?= htmlspecialchars($task['description'] ?? 'Aucune description pour le moment') ?></p>
    <a href="/POO/task-manager/public/tasks">Retour</a>
</body>
</html>
