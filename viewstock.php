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

// SQL query to fetch data from the stock table
$sql = "SELECT * FROM stock";
$result = $conn->query($sql);

// Display the table with styling
echo "<style>
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
            font-family: Arial, sans-serif;
        }
        th, td {
            padding: 10px;
            text-align: left;
            border: 1px solid #ddd;
        }
        th {
            background-color: #4CAF50;
            color: white;
        }
        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        tr:hover {
            background-color: #ddd;
        }
        .table-container {
            max-width: 1000px;
            margin: auto;
            overflow-x: auto;
        }
    </style>";

echo "<div class='table-container'>";
echo "<table>";
echo "<tr><th>Stock ID</th><th>Amount</th><th>Quantity Available</th><th>Unit Price</th><th>Status</th><th>Stock Date</th><th>Expiry Date</th></tr>";

while ($row = $result->fetch_assoc()) {
    echo "<tr>";
    echo "<td>" . htmlspecialchars($row['stockid']) . "</td>";
    echo "<td>" . htmlspecialchars($row['amount']) . "</td>";
    echo "<td>" . htmlspecialchars($row['quantityavailable']) . "</td>";
    echo "<td>" . htmlspecialchars($row['unitprice']) . "</td>";
    echo "<td>" . htmlspecialchars($row['status']) . "</td>";
    echo "<td>" . htmlspecialchars($row['stockdate']) . "</td>";
    echo "<td>" . htmlspecialchars($row['expirydate']) . "</td>";
    echo "</tr>";
}

echo "</table>";
echo "</div>";

$conn->close();
?>
