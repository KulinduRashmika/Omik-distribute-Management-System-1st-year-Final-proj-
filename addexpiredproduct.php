<?php
// Database connection
$conn = new mysqli("localhost", "root", "", "omik_distributor");

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the form was submitted via POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve form data
    $productid = $_POST['productid'];
    $quantity = $_POST['quantity'];
    $amount = $_POST['amount'];
    $totamount = $_POST['totamount'];

    // Prepare the SQL statement to insert data
    $sql = "INSERT INTO expireproducts (productid, quantity, amount, totamount) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);

    if ($stmt) {
        // Bind parameters to the SQL query
        $stmt->bind_param("sidd", $productid, $quantity, $amount, $totamount);

        // Execute the query
        if ($stmt->execute()) {
            echo "Expired product added successfully.";
        } else {
            echo "Failed to add expired product.";
        }

        // Close the statement
        $stmt->close();
    } else {
        echo "Error preparing statement: " . $conn->error;
    }
}

// Close the database connection
$conn->close();
?>
