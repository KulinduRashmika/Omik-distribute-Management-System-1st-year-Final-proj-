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

// Initialize response array
$response = array();

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $payrollid = $_POST['payrollid'];
    $month = $_POST['month'];
    $accno = $_POST['accno'];
    $basic = $_POST['basic'];
    $etf = $_POST['etf'];
    $totsalary = $_POST['totsalary'];

    // Prepare and bind SQL query to insert payroll data
    $sql = "INSERT INTO payroll (payrollid, month, accno, basic, etf, totsalary) 
            VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssdd", $payrollid, $month, $accno, $basic, $etf, $totsalary);

    // Execute query
    if ($stmt->execute()) {
        $response['status'] = 'success';
        $response['message'] = 'Payroll generated and added to the database successfully!';
    } else {
        $response['status'] = 'error';
        $response['message'] = 'Error: ' . $stmt->error;
    }

    // Close the statement and connection
    $stmt->close();
}

$conn->close();

// Return response as JSON
echo json_encode($response);
?>
