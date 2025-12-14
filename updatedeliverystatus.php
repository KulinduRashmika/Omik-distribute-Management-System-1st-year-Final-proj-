<?php
$conn = new mysqli("localhost", "root", "", "omik_distributor");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $cusid = $_POST['cusid'];
    $status = $_POST['deliverystatus'];

    $sql = "UPDATE cusorder SET deliverystatus = ? WHERE cusid = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $status, $cusid);

    if ($stmt->execute()) {
        echo "Delivery status updated successfully.";
    } else {
        echo "Error updating status: " . $conn->error;
    }

    $stmt->close();
}

$conn->close();
?>
