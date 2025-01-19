<?php

global $db;
include 'dbconnect.php';

$id = $_GET['id'];
$query = $db->prepare("SELECT * FROM smartphone WHERE id=" . $id);

$query->execute();
$result = $query->fetchALL(PDO::FETCH_ASSOC);
foreach ($result as $data) {
    echo "Artikelnummer: " . $data['id'] . "<br>";
    echo "Vendor: " . $data['vendor'] . "<br>";
    echo "Name: " . $data['name'] . "<br>";
    echo "Memory: " . $data['memory'] . "<br>";
    echo "Color: " . $data['color'] . "<br>";
    echo "Price:" . $data['price'] . "<br>";
}
?>
<br>
<a href="master.php">Terug naar master pagina</a>