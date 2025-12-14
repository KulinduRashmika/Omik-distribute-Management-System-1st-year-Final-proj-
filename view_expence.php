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

// SQL query to fetch data from the expensereport table
$sql = "SELECT * FROM expensereport";
$result = $conn->query($sql);

// Display the heading and table
echo "<h1 class='page-heading'>Expense Report</h1>";
echo "<table class='expense-table'>";
echo "<tr><th>Date</th><th>Description</th><th>Amount</th></tr>";

while ($row = $result->fetch_assoc()) {
    echo "<tr>";
    echo "<td>" . $row['date'] . "</td>";
    echo "<td>" . $row['description'] . "</td>";
    echo "<td>" . $row['amount'] . "</td>";
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

    table.expense-table {
        width: 80%;
        max-width: 900px;
        margin-top: 20px;
        border-collapse: collapse;
        background-color: #fff;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    table.expense-table th,
    table.expense-table td {
        padding: 12px;
        text-align: center;
        border: 1px solid #ddd;
    }

    table.expense-table th {
        background-color: #4CAF50;
        color: white;
    }

    table.expense-table tr:nth-child(even) {
        background-color: #f2f2f2;
    }

    table.expense-table tr:hover {
        background-color: #ddd;
    }

    table.expense-table td {
        font-size: 14px;
    }

    table.expense-table th {
        font-size: 16px;
    }

    table.expense-table td,
    table.expense-table th {
        border: 1px solid #ddd;
    }
</style>
