<?php
// Database configuration
$host = "localhost";
$username = "root";
$password = "";
$dbname = "omik_distributor";

// Create database connection
$conn = new mysqli($host, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get form data
$salespers = $_POST['salespers'];
$month = $_POST['month'];
$status = $_POST['status'];
$amount = $_POST['amount'];

// Insert data into the database
$sql = "INSERT INTO marketanalys (salespers, month, status, amount) VALUES ('$salespers', '$month', '$status', '$amount')";

if ($conn->query($sql) === TRUE) {
    echo "Report saved successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// Close the connection
$conn->close();
?>
