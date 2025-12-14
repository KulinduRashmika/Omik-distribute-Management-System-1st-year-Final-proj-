<?php
// Database connection
$connection = new mysqli('localhost', 'root', '', 'omik_distributor');

if ($connection->connect_error) {
    die('Database connection failed: ' . $connection->connect_error);
}

// Check if the request method is POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get data from the form
    $productid = $connection->real_escape_string($_POST['productid']);
    $pname = $connection->real_escape_string($_POST['pname']);
    $price = floatval($_POST['price']);
    $productcertificat = $connection->real_escape_string($_POST['productcertificat']); // Add this line to handle certification field

    // Prepare and execute the SQL query to insert data
    $query = "INSERT INTO productcertification (productid, pname, price, productcertificat) VALUES (?, ?, ?, ?)";
    $stmt = $connection->prepare($query);
    $stmt->bind_param('ssds', $productid, $pname, $price, $productcertificat); // Add 's' for the certification field

    // Check if the query was successful
    if ($stmt->execute()) {
        echo "Product details saved successfully!";
    } else {
        echo "Failed to save product data.";
    }

    // Close the statement
    $stmt->close();
}

// Close the database connection
$connection->close();
?>
