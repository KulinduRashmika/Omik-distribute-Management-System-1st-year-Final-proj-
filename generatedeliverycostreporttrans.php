<?php
// Connection to the database
$conn = new mysqli("localhost", "root", "", "omik_distributor");

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get form data
    $deliveryid = $_POST['deliveryid'];
    $customerid = $_POST['customerid'];
    $deliveryadd = $_POST['deliveryadd'];
    $deliverydate = $_POST['deliverydate'];
    $deliverycost = $_POST['deliverycost'];
    $status = $_POST['status'];

    // Prepare the SQL query
    $sql = "INSERT INTO deliveryreport (deliveryid, customerid, deliveryadd, deliverydate, deliverycost, status)
            VALUES (?, ?, ?, ?, ?, ?)";

    // Use prepared statements to prevent SQL injection
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssds", $deliveryid, $customerid, $deliveryadd, $deliverydate, $deliverycost, $status);

    // Execute the query and check for success
    if ($stmt->execute()) {
        echo "Delivery cost report generated successfully.";
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close the statement and connection
    $stmt->close();
    $conn->close();
}
?>
