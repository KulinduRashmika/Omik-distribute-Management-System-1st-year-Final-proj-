<?php
// Database configuration
$servername = "localhost";
$username = "root"; 
$password = ""; 
$dbname = "omik_distributor"; 

// Establish connection to the database
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve form data
$reportname = $_POST['reportname'];
$reportdate = $_POST['reportdate'];
$amount = $_POST['amount'];
$description = $_POST['description'];

// SQL query to insert data into the financialreports table
$sql = "INSERT INTO financialreports (reportname, reportdate, amount, description) 
        VALUES ('$reportname', '$reportdate', '$amount', '$description')";

// Check if the query is successful
if ($conn->query($sql) === TRUE) {
    echo "<h3>Financial Report Successfully Added!</h3>";
    echo "<a href='generatefinancialreport.html'>Generate Another Report</a>";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// Close connection
$conn->close();
?>
