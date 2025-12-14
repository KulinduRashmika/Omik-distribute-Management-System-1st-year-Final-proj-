<?php
// Database connection
$conn = new mysqli("localhost", "root", "", "omik_distributor");

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Update approval status
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Ensure data is received and validated
    if (isset($_POST['cusid']) && isset($_POST['approvestatus'])) {
        $cusid = $_POST['cusid'];
        $approvestatus = $_POST['approvestatus'];

        // Sanitize the input
        $cusid = $conn->real_escape_string($cusid);
        $approvestatus = $conn->real_escape_string($approvestatus);

        // Prepare the SQL statement
        $sql = "UPDATE cusorder SET approvestatus = ? WHERE cusid = ?";
        $stmt = $conn->prepare($sql);

        if ($stmt) {
            // Bind parameters and execute
            $stmt->bind_param("si", $approvestatus, $cusid);

            if ($stmt->execute()) {
                echo "Approval status updated successfully.";
            } else {
                echo "Failed to update approval status.";
            }

            // Close the prepared statement
            $stmt->close();
        } else {
            echo "Error preparing statement: " . $conn->error;
        }
    } else {
        echo "Invalid input data.";
    }
}

$conn->close();
?>
