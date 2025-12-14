<?php
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

// Get form data
$invoiceno = $_POST['invoiceno'];
$cusname = $_POST['cusname'];
$invoicedate = $_POST['invoicedate'];
$totamount = $_POST['totamount'];
$paymentmethod = $_POST['paymentmethod'];

// Prepare and execute SQL statement
$sql = "INSERT INTO invoice (invoiceno, cusname, invoicedate, totamount, paymentmethod) VALUES ('$invoiceno', '$cusname', '$invoicedate', '$totamount', '$paymentmethod')";

if ($conn->query($sql) === TRUE) {
    echo "New invoice added successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>