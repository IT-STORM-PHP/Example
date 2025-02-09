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
        <label for="">Status</label>
        <select name="status" id="">
            <?php
                if ($task['status']==0){
            ?>
                <option value="0">En cours</option>
                <option value="1">Terminé</option>
            <?php
                } else{
            ?>
                <option value="1">Terminé</option>
                <option value="0">En cours</option>
            <?php
                }
            ?>            
        </select>
        <button type="submit">Mettre à jour</button>
    </form>
</body>
</html>
