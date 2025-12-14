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

// SQL query to fetch data from the salereport table
$sql = "SELECT * FROM salereport";
$result = $conn->query($sql);

// Display the heading and table
echo "<h1 class='page-heading'>Sales Report</h1>";
echo "<table class='sales-table'>";
echo "<tr><th>Sale ID</th><th>Quantity</th><th>Total Amount</th><th>Unit Price</th></tr>";

while ($row = $result->fetch_assoc()) {
    echo "<tr>";
    echo "<td>" . $row['saleid'] . "</td>";
    echo "<td>" . $row['qty'] . "</td>";
    echo "<td>" . $row['totamount'] . "</td>";
    echo "<td>" . $row['unitprice'] . "</td>";
    echo "</tr>";
}

echo "</table>";

$conn->close();
?>

<style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f4f4f4;
        margin: 0;
        padding: 0;
        display: flex;
        justify-content: center;
        align-items: center;
        min-height: 100vh;
        flex-direction: column;
    }

    .page-heading {
        font-size: 24px;
        color: #333;
        margin-bottom: 20px;
    }

    table.sales-table {
        width: 80%;
        max-width: 900px;
        margin-top: 20px;
        border-collapse: collapse;
        background-color: #fff;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    table.sales-table th,
    table.sales-table td {
        padding: 12px;
        text-align: center;
        border: 1px solid #ddd;
    }

    table.sales-table th {
        background-color: #4CAF50;
        color: white;
    }

    table.sales-table tr:nth-child(even) {
        background-color: #f2f2f2;
    }

    table.sales-table tr:hover {
        background-color: #ddd;
    }

    table.sales-table td {
        font-size: 14px;
    }

    table.sales-table th {
        font-size: 16px;
    }

    table.sales-table td,
    table.sales-table th {
        border: 1px solid #ddd;
    }
</style>
