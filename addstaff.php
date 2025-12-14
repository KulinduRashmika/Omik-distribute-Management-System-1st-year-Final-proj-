<?php
// Database connection
$conn = new mysqli("localhost", "root", "", "omik_distributor");

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $staff_id = $_POST["staffid"];  // Correct the missing semicolon here
    $staff_name = $_POST["staffname"];
    $email = $_POST["email"];
    $phone = $_POST["phone"];
    $position = $_POST["position"];
    $department = $_POST["department"];
    $address = $_POST["address"];

    // SQL to insert data into the staff table
    $sql = "INSERT INTO staff (staffid, staffname, email, phone, position, department, address)
            VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);

    // Correct variable names in the bind_param method
    $stmt->bind_param("sssssss", $staff_id, $staff_name, $email, $phone, $position, $department, $address);

    if ($stmt->execute()) {
        echo "New staff member added successfully!";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>
