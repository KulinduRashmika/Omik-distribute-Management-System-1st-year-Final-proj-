<?php
// Database configuration
$host = 'localhost';  
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
        $date = $_POST['date'];
        $description = $_POST['description'];
        $amount = $_POST['amount'];
       
        // Prepare the SQL query to insert data
        $sql = "INSERT INTO expensereport (date, description, amount) 
                VALUES (:date, :description, :amount)";

        // Prepare statement
        $stmt = $conn->prepare($sql);

        // Bind the form data to the SQL query
        $stmt->bindParam(':date', $date);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':amount', $amount);
       

        // Execute the query
        if ($stmt->execute()) {
            echo "<p>Expense Report submitted successfully!</p>";
        } else {
            echo "<p>Failed to submit report. Please try again.</p>";
        }
    }

} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>
