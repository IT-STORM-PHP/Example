<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Category</title>
</head>
<body>
    
   <table border="10" cellspacing="0" cellpadding="0">
    
    <thead>
        <tr>
            <th>Id</th>
            <th>Titre</th>
            <th>Ajouté le</th>
        </tr>
    </thead>
    <tbody>
    <?php foreach($category as $cat) :?>
        <tr>
            <td><?= $cat['id'] ?></td>
            <td><?= $cat['title'] ?></td>
            <td><?= $cat['created_at'] ?></td>
        </tr>
    <?php endforeach ;?> 
    </tbody>
   </table>   
</body>
</html>