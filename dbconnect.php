<?php
try {
    $db = new PDO("mysql:host=localhost;dbname=smartphone4u",
        "root", "");
} catch (PDOException $e) {
    die("Error!:" . $e->getMessage());
}
?>