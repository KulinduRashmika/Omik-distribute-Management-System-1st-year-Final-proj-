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
        $empid = $_POST['empid'];
        $date = $_POST['date'];
        $intime = $_POST['intime'];
        $outtime = $_POST['outtime'];

        // Prepare the SQL query to insert data
        $sql = "INSERT INTO attendence (empid, date, intime, outtime) 
                VALUES (:empid, :date, :intime, :outtime)";

        // Prepare statement
        $stmt = $conn->prepare($sql);

        // Bind the form data to the SQL query
        $stmt->bindParam(':empid', $empid);
        $stmt->bindParam(':date', $date);
        $stmt->bindParam(':intime', $intime);
        $stmt->bindParam(':outtime', $outtime);

        // Execute the query
        if ($stmt->execute()) {
            echo "<p>Attendence submitted successfully!</p>";
        } else {
            echo "<p>Failed to submit attendence. Please try again.</p>";
        }
    }

} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>
