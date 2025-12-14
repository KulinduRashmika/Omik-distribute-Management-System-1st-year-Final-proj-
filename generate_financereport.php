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

// SQL query to fetch data from the financialreports table
$sql = "SELECT * FROM financialreports";
$result = $conn->query($sql);

// Display the heading and table
echo "<h1 class='page-heading'>Financial Report</h1>";
echo "<table class='financial-table'>";
echo "<tr><th>Report Name</th><th>Report Date</th><th>Amount</th><th>Description</th></tr>";

while ($row = $result->fetch_assoc()) {
    echo "<tr>";
    echo "<td>" . $row['reportname'] . "</td>";
    echo "<td>" . $row['reportdate'] . "</td>";
    echo "<td>" . $row['amount'] . "</td>";
    echo "<td>" . $row['description'] . "</td>";
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

    table.financial-table {
        width: 80%;
        max-width: 900px;
        margin-top: 20px;
        border-collapse: collapse;
        background-color: #fff;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    table.financial-table th,
    table.financial-table td {
        padding: 12px;
        text-align: center;
        border: 1px solid #ddd;
    }

    table.financial-table th {
        background-color: #4CAF50;
        color: white;
    }

    table.financial-table tr:nth-child(even) {
        background-color: #f2f2f2;
    }

    table.financial-table tr:hover {
        background-color: #ddd;
    }

    table.financial-table td {
        font-size: 14px;
    }

    table.financial-table th {
        font-size: 16px;
    }

    table.financial-table td,
    table.financial-table th {
        border: 1px solid #ddd;
    }
</style>
