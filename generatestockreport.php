<?php
// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve form data and sanitize inputs
    $stockid = htmlspecialchars(trim($_POST['stockid']));
    $amount = filter_var($_POST['amount'], FILTER_VALIDATE_FLOAT);
    $quantityavailable = filter_var($_POST['quantityavailable'], FILTER_VALIDATE_INT);
    $unitprice = filter_var($_POST['unitprice'], FILTER_VALIDATE_FLOAT);
    $status = htmlspecialchars(trim($_POST['status']));
    $customstatus = htmlspecialchars(trim($_POST['customstatus']));
    $stockdate = htmlspecialchars(trim($_POST['stockdate']));
    $expirydate = htmlspecialchars(trim($_POST['expirydate']));

    // Use custom status if provided
    if ($status === "custom" && !empty($customStatus)) {
        $status = $customStatus;
    }

    // Validate required fields server-side
    $errors = [];

    if (empty($stockid)) {
        $errors[] = "StockID is required.";
    }
    if ($amount === false || $amount <= 0) {
        $errors[] = "Amount must be a positive number.";
    }
    if ($quantityavailable === false || $quantityavailable < 0) {
        $errors[] = "Quantity Available must be a non-negative number.";
    }
    if ($unitprice === false || $unitprice <= 0) {
        $errors[] = "Unit Price must be a positive number.";
    }
    if (empty($status)) {
        $errors[] = "Status is required.";
    }
    if (empty($stockdate)) {
        $errors[] = "Date Added is required.";
    }
    if (empty($expirydate)) {
        $errors[] = "Expiry Date is required.";
    }
    if (!empty($stockdate) && !empty($expirydate) && $stockdate > $expirydate) {
        $errors[] = "Expiry Date cannot be earlier than Date Added.";
    }

    // Display errors or process data
    if (!empty($errors)) {
        // Show errors
        echo "<h3>Validation Errors:</h3><ul>";
        foreach ($errors as $error) {
            echo "<li>" . htmlspecialchars($error) . "</li>";
        }
        echo "</ul>";
    } else {
        // Connect to the database 
        $host = "localhost";
        $username = "root";
        $password = "";
        $database = "omik_distributor";

        $conn = new mysqli($host, $username, $password, $database);

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Prepare and bind SQL query
        $stmt = $conn->prepare("INSERT INTO stock (stockid, amount, quantityavailable, unitprice, status, stockdate, expirydate) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sdidsss", $stockid, $amount, $quantityavailable, $unitprice, $status, $stockdate, $expirydate);

        if ($stmt->execute()) {
            echo "<h3>Stock report generated successfully!</h3>";
        } else {
            echo "<h3>Error: " . $stmt->error . "</h3>";
        }

        // Close connection
        $stmt->close();
        $conn->close();
    }
} else {
    echo "<h3>Invalid request method.</h3>";
}
?>
