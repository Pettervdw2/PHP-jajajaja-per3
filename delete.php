<?php
try {
    $db = new PDO("mysql:host=localhost;dbname=smartphone4u", "root", "");

    if (isset($_GET['id'])) {
        $id = filter_input(INPUT_GET, "id", FILTER_SANITIZE_NUMBER_INT);

        $query = $db->prepare("SELECT * FROM smartphone WHERE id = :id");
        $query->bindParam(":id", $id, PDO::PARAM_INT);
        $query->execute();
        $data = $query->fetch(PDO::FETCH_ASSOC);

        if (!$data) {
            echo "Geen smartphone gevonden met die ID.";
            exit;
        }

        if (isset($_POST['confirm_delete'])) {
            $deleteQuery = $db->prepare("DELETE FROM smartphone WHERE id = :id");
            $deleteQuery->bindParam(":id", $id, PDO::PARAM_INT);
            $deleteQuery->execute();

            header("Location: master.php");
            exit();
        }

        if (isset($_POST['cancel_delete'])) {
            header("Location: master.php");
            exit();
        }
    } else {
        echo "Geen ID opgegeven voor verwijdering.";
        exit();
    }
} catch (PDOException $e) {
    die("Error!:" . $e->getMessage());
}
?>

<h3>Weet je zeker dat je de volgende smartphone wilt deleten?</h3>
<p>Vendor: <?php echo htmlspecialchars($data['vendor']); ?></p>

<p>Name: <?php echo isset($data['name']) ? htmlspecialchars($data['name']) : 'Onbekend'; ?></p>

<p>Memory: <?php echo htmlspecialchars($data['memory']); ?>

<p>Color: <?php echo htmlspecialchars($data['color']); ?>

<p>Prijs: <?php echo htmlspecialchars($data['price']); ?> EUR</p>

<form action="delete.php?id=<?php echo $data['id']; ?>" method="POST">
    <input type="submit" name="confirm_delete" value="Ja, delete deze smartphone">
    <input type="submit" name="cancel_delete" value="Annuleer">
</form>
