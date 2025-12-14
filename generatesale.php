
<?php
//close
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

// Handle form submissions
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['add'])) {
        // Add new record
        $saleid = $_POST['saleid'];
        $qty = $_POST['qty'];
        $unitprice = $_POST['unitprice'];
        $totamount = $qty * $unitprice; // Calculate total amount

        $sql = "INSERT INTO salereport (saleid, qty, totamount, unitprice) VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("iidd", $saleid, $qty, $totamount, $unitprice);

        if ($stmt->execute()) {
            echo "New sale report added successfully.";
            header("Location: generatesale.php"); // Redirect to the main page
        } else {
            echo "Error: " . $stmt->error;
        }
        $stmt->close();
    }
}

// Close the database connection
$conn->close();
?>