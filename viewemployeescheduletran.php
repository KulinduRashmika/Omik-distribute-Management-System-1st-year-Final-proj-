<?php
// Database configuration
$host = "localhost";
$user = "root";
$password = ""; 
$dbname = "omik_distributor";

// Create connection
$conn = new mysqli($host, $user, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch schedules from the database
$sql = "SELECT esid, esname, description, date FROM employeeschedule";
$result = $conn->query($sql);

$schedules = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $schedules[] = $row;
    }
}

// Return data as JSON
echo json_encode($schedules);

// Close connection
$conn->close();
?>
