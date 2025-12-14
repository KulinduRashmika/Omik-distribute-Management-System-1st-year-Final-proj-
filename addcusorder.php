<?php
$connection = new mysqli('localhost', 'root', '', 'omik_distributor');

if ($connection->connect_error) {
    die('Database connection failed: ' . $connection->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $cusid = intval($_POST['cusid']);
    $address = $connection->real_escape_string($_POST['address']);

    $query = "INSERT INTO cusorder (cusid, address) VALUES (?, ?)";
    $stmt = $connection->prepare($query);
    $stmt->bind_param('is', $cusid, $address);

    if ($stmt->execute()) {
        echo "Customer order added successfully!";
    } else {
        echo "Failed to add customer order.";
    }

    $stmt->close();
}

$connection->close();
?>
