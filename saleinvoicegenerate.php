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
$saleinvoiceid = $_POST['saleinvoiceid'];
$uprice = $_POST['uprice'];
$qty = $_POST['qty'];
$totamount = $_POST['totamount'];
$outstandingbalance = $_POST['outstandingbalance'];

// Prepare and execute SQL statement
$sql = "INSERT INTO saleinvoice (saleinvoiceid, uprice, qty, totamount, outstandingbalance) VALUES ('$saleinvoiceid', '$uprice', '$qty', '$totamount', '$outstandingbalance')";

if ($conn->query($sql) === TRUE) {
    echo "New sale invoice added successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>