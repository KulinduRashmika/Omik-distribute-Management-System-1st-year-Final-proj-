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

// SQL query to select all data from the 'stock' table
$sql = "SELECT * FROM stock";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Start the HTML table with a class for styling
    echo "<!DOCTYPE html>";
    echo "<html lang='en'>";
    echo "<head>";
    echo "<meta charset='UTF-8'>";
    echo "<meta name='viewport' content='width=device-width, initial-scale=1.0'>";
    echo "<title>Stock List</title>";
    echo "<link href='https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css' rel='stylesheet'>";
    echo "</head>";
    echo "<body>";
    echo "<div class='container mt-5'>";
    echo "<h2 class='text-center mb-4'>Stock List</h2>";
    echo "<table class='table table-striped table-bordered'>";
    echo "<thead>";
    echo "<tr>";
    echo "<th>Stock ID</th>";
    echo "<th>Amount</th>";
    echo "<th>Quantity Available</th>";
    echo "<th>Unit Price</th>";
    echo "<th>Status</th>";
    echo "<th>Stock Date</th>";
    echo "<th>Expiry Date</th>";
    echo "</tr>";
    echo "</thead>";
    echo "<tbody>";

    // Fetching rows from the database and displaying them in table
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . htmlspecialchars($row["stockid"]) . "</td>";
        echo "<td>" . htmlspecialchars($row["amount"]) . "</td>";
        echo "<td>" . htmlspecialchars($row["quantityavailable"]) . "</td>";
        echo "<td>" . htmlspecialchars($row["unitprice"]) . "</td>";
        echo "<td>" . htmlspecialchars($row["status"]) . "</td>";
        echo "<td>" . htmlspecialchars($row["stockdate"]) . "</td>";
        echo "<td>" . htmlspecialchars($row["expirydate"]) . "</td>";
        echo "</tr>";
    }

    echo "</tbody>";
    echo "</table>";
    echo "</div>";
    echo "</body>";
    echo "</html>";
} else {
    echo "No stock data found.";
}

$conn->close();
?>
