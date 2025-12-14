<?php
// Database connection
$connection = new mysqli('localhost', 'root', '', 'omik_distributor');

if ($connection->connect_error) {
    die('Database connection failed: ' . $connection->connect_error);
}

// Handle the update request
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['update_order'])) {
        $suporderid = intval($_POST['suporderid']);  // Cast the ID to an integer for security
        $status = htmlspecialchars($_POST['status']);  // Sanitize the status input

        if (empty($suporderid) || empty($status)) {
            echo "Error: Order ID and Status are required.";
        } else {
            $query = "UPDATE suporder SET status = ? WHERE suporderid = ?";
            $stmt = $connection->prepare($query);
            $stmt->bind_param("si", $status, $suporderid);  // Bind the status and ID

            if ($stmt->execute()) {
                echo "Order status updated successfully!";
            } else {
                echo "Error: " . $stmt->error;
            }

            $stmt->close();
        }
    }
}

$connection->close();
?>
