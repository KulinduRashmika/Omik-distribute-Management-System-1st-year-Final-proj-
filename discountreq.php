<?php
// Database configuration
$host = "localhost";
$username = "root";
$password = "";
$dbname = "omik_distributor";

// Create a database connection
$conn = new mysqli($host, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if POST request is valid
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Validate and sanitize the input
    $discountID = htmlspecialchars($_POST['discountID']);
    $productName = htmlspecialchars($_POST['productName']);
    $originalPrice = floatval($_POST['originalPrice']);
    $discountAmount = floatval($_POST['discountAmount']);
    $startDate = $_POST['startDate'];
    $endDate = $_POST['endDate'];

    // Calculate the discounted price
    $discountedPrice = $originalPrice - ($originalPrice * ($discountAmount / 100));

    // Use a prepared statement to prevent SQL injection
    $sql = "INSERT INTO discounts (discountID, productName, originalPrice, discountAmount, discountedPrice, startDate, endDate) 
            VALUES (?, ?, ?, ?, ?, ?, ?)";
    
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssdidss", $discountID, $productName, $originalPrice, $discountAmount, $discountedPrice, $startDate, $endDate);
    
    // Execute the query and check for success
    if ($stmt->execute()) {
        echo "Discount request submitted successfully.";
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close the prepared statement
    $stmt->close();
} else {
    echo "Invalid request method.";
}

// Close the connection
$conn->close();
?>
