<?php
// Database connection details
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

// Handle form submissions
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['add'])) {
        // Add new record
        $taskname = $_POST['taskname'];
        $startdate = $_POST['startdate'];
        $enddate = $_POST['enddate'];
        $Type = $_POST['Type'];
        $value = $_POST['value'];

        $sql = "INSERT INTO tasks (TaskName, StartDate, EndDate, Type, Value) VALUES (?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssssi", $taskname, $startdate, $enddate, $Type, $value);

        if ($stmt->execute()) {
            echo "New task added successfully.";
            header("Location: addtask.php"); // Redirect to the main page
        } else {
            echo "Error: " . $stmt->error;
        }
        $stmt->close();
    }
}

// Close the database connection
$conn->close();
?>