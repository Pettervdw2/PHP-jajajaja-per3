<?php
include_once "dbconnect.php";

$errorVendor = '';
$errorName = '';
$errorMemory = '';
$errorColor = '';
$errorPrice = '';


$vendor = filter_input(INPUT_POST, 'vendor', FILTER_SANITIZE_SPECIAL_CHARS);

$name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_SPECIAL_CHARS);

$memory = filter_input(INPUT_POST, 'memory', FILTER_VALIDATE_FLOAT);

$color = filter_input(INPUT_POST, 'color', FILTER_SANITIZE_SPECIAL_CHARS);

$price = filter_input(INPUT_POST, 'price', FILTER_VALIDATE_FLOAT);

$vendor = trim($vendor);

if (isset($_POST['insert'])) {
    if (empty($vendor)) {
        $errorVendor['vendor'] = 'Vendor invullen';
    }
    if (empty($name)) {
        $errorName['name'] = 'Vendor invullen';
    }
    if ($memory===false) {
        $errorMemory['memory'] = 'Memory invullen';
    }
    if (empty($color)) {
        $errorColor['color'] = 'Color invullen';
    }
    if ($price===false) {
        $errorPrice['price'] = 'Price invullen';
    }

    if ($errorVendor=='' && $errorName=='' && $errorMemory=='' && $errorColor=='' && $errorPrice=='') {
        global $db;
        //var_dump($inputs);
        //die;
        $query = $db->prepare('INSERT INTO smartphone(vendor,name,memory,color,price) VALUES (:vendor,:name,:memory,:color,:price)');
        $query->bindParam(':vendor', $vendor);
        $query->bindParam(':name', $name);
        $query->bindParam(':memory', $memory);
        $query->bindParam(':color', $color);
        $query->bindParam(':price', $price);
        $query->execute();
        header("location: master.php");
    }
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Insert pagina</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous" defer></script>
</head>
<body>
    <h1>Insert smartphone</h1>
    <form method="post">
        <label for="vendor">Vendor</label><br>
        <input type="text" name="vendor" id="vendor" value="<?=$vendor ?? ''?>"><br>
        <?=$errorVendor?><br>
        <label for="name">Name</label><br>
        <input type="text" name="name" id="name" value="<?=$name ?? ''?>"><br>
        <?=$errorName?><br>
        <label for="memory">Memory</label><br>
        <input type="number" name="memory" id="memory" value="<?=$memory ?? ''?>"><br>
        <?=$errorMemory?><br>
        <label for="color">Color</label><br>
        <input type="text" name="color" id="color" value="<?=$color ?? ''?>"><br>
        <?=$errorColor?><br>
        <label for="price">Price</label><br>
        <input type="number" name="price" id="price" value="<?=$price ?? ''?>"><br>
        <?=$errorPrice?><br>
        <input type="submit" value="opslaan" name="insert">
    </form>
</body>
</html>
