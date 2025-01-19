
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Update</title>
</head>
<body>
<h1>Insert smartphone</h1>
<form method="post">
    <label for="vendor">Vendor</label><br>
    <input type="text" name="vendor" id="vendor" value="<?=$vendor ?? ''?>"><br>
    <label for="name">Name</label><br>
    <input type="text" name="name" id="name" value="<?=$name ?? ''?>"><br>
    <label for="memory">Memory</label><br>
    <input type="number" name="memory" id="memory" value="<?=$memory ?? ''?>"><br>
    <label for="color">Color</label><br>
    <input type="text" name="color" id="color" value="<?=$color ?? ''?>"><br>
    <label for="price">Price</label><br>
    <input type="number" name="price" id="price" value="<?=$price ?? ''?>"><br>
    <input type="submit" value="opslaan" name="insert">
</form>
</body>
</html>

<?php
global $db;

try {
    $db = new PDO("mysql:host=localhost;dbname=smartphone4u",
        "root", "");
    if (isset($_POST['insert'])) {
        $vendor = filter_input(INPUT_POST, 'vendor', FILTER_SANITIZE_SPECIAL_CHARS);

        $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_SPECIAL_CHARS);

        $memory = filter_input(INPUT_POST, 'memory', FILTER_VALIDATE_FLOAT);

        $color = filter_input(INPUT_POST, 'color', FILTER_SANITIZE_SPECIAL_CHARS);

        $price = filter_input(INPUT_POST, 'price', FILTER_VALIDATE_FLOAT);

        $query = $db->prepare("UPDATE smartphone SET vendor = :vendor, name = :name, memory = :memory, color = :color, price = :price WHERE id = :id");
        $query->bindParam(':vendor', $vendor);
        $query->bindParam(':name', $name);
        $query->bindParam(':memory', $memory);
        $query->bindParam(':color', $color);
        $query->bindParam(':price', $price);
        $query->bindParam('id', $_GET['id']);
        if ($query->execute()) {
            echo 'De nieuwe gegevens zijn toegevoegd';
            header("location: master.php");
        } else {
            echo 'Er is een fout opgetreden';
        }
        echo "<br>";
    } else {
        $query = $db->prepare("SELECT * FROM smartphone WHERE id = :id");
        $query->bindParam("id", $_GET['id']);
        $query->execute();
        $result = $query->fetchAll(PDO::FETCH_ASSOC);

        foreach ($result as $data) {
            $vendor = $data["vendor"];
            $name = $data["name"];
            $memory = $data["memory"];
            $color = $data["color"];
            $price = $data["price"];
        }
    }
} catch (PDOException $e) {
    die("Error!:" . $e->getMessage());
}
?>
