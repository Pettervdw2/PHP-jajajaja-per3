
<?php
include_once 'dbconnect.php';
include_once 'class.php';
global $db;

$query = $db->prepare('SELECT * FROM smartphone');
$query->execute();
$smartphones=$query->fetchAll(PDO::FETCH_CLASS, 'Smartphone');
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous" defer></script>
    <title>Read</title>
</head>
<body>
<div class="container">
    <h1>Smartphones</h1>
    <table class="table">
        <tr>
            <th>vendor</th>
            <th>name</th>
            <th class="text-center">details</th>
            <th class="text-center">update</th>
            <th class="text-center">delete</th>
        </tr>
        <?php foreach ($smartphones as $smartphone):?>
            <tr>
                <td><?=$smartphone->vendor?></td>
                <td><?=$smartphone->name?></td>
                <td class="text-center"><a href="details.php?id=<?=$smartphone->id?>">details</a></td>
                <td class="text-center"><a href="update.php?id=<?=$smartphone->id?>">update</a></td>
                <td class="text-center"><a href="delete.php?id=<?=$smartphone->id?>">delete</a></td>
            </tr>
        <?php endforeach;?>
    </table>
    <a href="insert.php">insert</a>
</div>
</body>
</html>