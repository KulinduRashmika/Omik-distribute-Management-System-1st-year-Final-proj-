<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "omik_distributor";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get form data
$esid = $_POST['esid'];       // Use consistent lowercase variable names
$esname = $_POST['esname'];
$description = $_POST['description'];
$date = $_POST['date'];

// Prepare and bind SQL statement to prevent SQL injection
$sql = "INSERT INTO employeeschedule (esid, esname, description, date) VALUES (?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ssss", $esid, $esname, $description, $date);  // Use bind_param to securely insert variables

// Execute the query and check for success
if ($stmt->execute()) {
    echo "Schedule generated successfully!";
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
