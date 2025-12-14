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

// Retrieve form data (with basic sanitization)
$staff_id = isset($_POST['staff_id']) ? htmlspecialchars($_POST['staff_id']) : '';
$staff_name = isset($_POST['staff_name']) ? htmlspecialchars($_POST['staff_name']) : '';
$date = isset($_POST['date']) ? htmlspecialchars($_POST['date']) : '';
$attendance_status = isset($_POST['attendance_status']) ? htmlspecialchars($_POST['attendance_status']) : '';
$comments = isset($_POST['comments']) ? htmlspecialchars($_POST['comments']) : '';

// Check if mandatory fields are filled
if (empty($staff_id) || empty($staff_name) || empty($date) || empty($attendance_status)) {
    echo "Please fill all required fields.";
} else {
    // Prepare and execute the SQL statement
    $sql = "INSERT INTO staff_report (staff_id, staff_name, date, attendance_status, comments)
            VALUES (?, ?, ?, ?, ?)";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssss", $staff_id, $staff_name, $date, $attendance_status, $comments);

    if ($stmt->execute()) {
        echo "Staff report generated successfully.";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

// Close the database connection
$conn->close();
?>