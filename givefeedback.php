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
        $feedbackid = $_POST['feedbackid'];
        $customername = $_POST['customername'];
        $date = $_POST['date'];
        $content = $_POST['content'];

        // Prepare the SQL query to insert data
        $sql = "INSERT INTO feedback (feedbackid, customername, date, content) 
                VALUES (:feedbackid, :customername, :date, :content)";

        // Prepare statement
        $stmt = $conn->prepare($sql);

        // Bind the form data to the SQL query
        $stmt->bindParam(':feedbackid', $feedbackid);
        $stmt->bindParam(':customername', $customername);
        $stmt->bindParam(':date', $date);
        $stmt->bindParam(':content', $content);

        // Execute the query
        if ($stmt->execute()) {
            echo "<p>Feedback submitted successfully!</p>";
        } else {
            echo "<p>Failed to submit feedback. Please try again.</p>";
        }
    }

} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>
