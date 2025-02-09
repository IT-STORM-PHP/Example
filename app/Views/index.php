<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Base Controller</title>
</head>
<body>
    <div class="container">
        <?= htmlspecialchars("$nom") ?>
        <?php
            if ($age>=20){
                echo "Plus de 20 ans";
            }else {
                echo "Moins de 20ans";
            }
        ?>
    </div>
</body>
</html>