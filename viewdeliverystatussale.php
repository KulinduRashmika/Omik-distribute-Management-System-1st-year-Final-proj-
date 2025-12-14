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

// SQL query to fetch data from the suporder table
$sql = "SELECT * FROM suporder";
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
echo "<tr><th>Supplier Order ID</th><th>Order Name</th><th>Amount</th><th>Status</th><th>Quantity</th></tr>";

while ($row = $result->fetch_assoc()) {
    echo "<tr>";
    echo "<td>" . htmlspecialchars($row['suporderid']) . "</td>";
    echo "<td>" . htmlspecialchars($row['ordername']) . "</td>";
    echo "<td>" . htmlspecialchars($row['amount']) . "</td>";
    echo "<td>" . htmlspecialchars($row['status']) . "</td>";
    echo "<td>" . htmlspecialchars($row['qty']) . "</td>";
    echo "</tr>";
}

echo "</table>";
echo "</div>";

$conn->close();
?>
