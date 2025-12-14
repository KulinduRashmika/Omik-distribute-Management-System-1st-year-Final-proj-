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
        $revenueid = $_POST['revenueid'];
        $amount = $_POST['amount'];
        $date = $_POST['date'];
        $source = $_POST['source'];

        // Prepare the SQL query to insert data
        $sql = "INSERT INTO revenue (revenueid, amount, date, source) 
                VALUES (:revenueid, :amount, :date, :source)";

        // Prepare statement
        $stmt = $conn->prepare($sql);

        // Bind the form data to the SQL query
        $stmt->bindParam(':revenueid', $revenueid);
        $stmt->bindParam(':amount', $amount);
        $stmt->bindParam(':date', $date);
        $stmt->bindParam(':source', $source);

        // Execute the query
        if ($stmt->execute()) {
            echo "<p>revenue submitted successfully!</p>";
        } else {
            echo "<p>Failed to submit revenue. Please try again.</p>";
        }
    }

} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>
