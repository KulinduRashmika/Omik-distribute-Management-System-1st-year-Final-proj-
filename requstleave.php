<?php
// Database configuration
$host = 'localhost';  // Database host
$dbname = 'omik_distributor';
$username = 'root'; 
$password = '';  

try {
    // Connect to the database using PDO
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    // Set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Check if the form is submitted
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // Collect form data
        $sid = $_POST['sid'];
        $leavedate = $_POST['leavedate'];
        $enddate = $_POST['enddate'];
        $reason = $_POST['reason'];
       

        // Prepare the SQL query to insert data
        $sql = "INSERT INTO leavereq (sid, leavedate, enddate, reason) 
                VALUES (:sid, :leavedate, :enddate, :reason)";

        // Prepare statement
        $stmt = $conn->prepare($sql);

        // Bind the form data to the SQL query
        $stmt->bindParam(':sid', $sid);
        $stmt->bindParam(':leavedate', $leavedate);
        $stmt->bindParam(':enddate', $enddate);
        $stmt->bindParam(':reason', $reason);
        

        // Execute the query
        if ($stmt->execute()) {
            echo "<p>Leve Request submitted successfully!</p>";
        } else {
            echo "<p>Failed to submit request. Please try again.</p>";
        }
    }

} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>
