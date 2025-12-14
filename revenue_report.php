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

// SQL query to fetch data from the revenue table
$sql = "SELECT * FROM revenue";
$result = $conn->query($sql);

// Display the heading and table
echo "<h1 class='page-heading'>Revenue Report</h1>";
echo "<table class='revenue-table'>";
echo "<tr><th>Revenue ID</th><th>Date</th><th>Source</th><th>Amount</th><th>Confirmation</th></tr>";

while ($row = $result->fetch_assoc()) {
    echo "<tr>";
    echo "<td>" . $row['revenueid'] . "</td>";
    echo "<td>" . $row['date'] . "</td>";
    echo "<td>" . $row['source'] . "</td>";
    echo "<td>" . $row['amount'] . "</td>";
    echo "<td>" . $row['confirmation'] . "</td>";
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

    table.revenue-table {
        width: 80%;
        max-width: 900px;
        margin-top: 20px;
        border-collapse: collapse;
        background-color: #fff;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    table.revenue-table th,
    table.revenue-table td {
        padding: 12px;
        text-align: center;
        border: 1px solid #ddd;
    }

    table.revenue-table th {
        background-color: #4CAF50;
        color: white;
    }

    table.revenue-table tr:nth-child(even) {
        background-color: #f2f2f2;
    }

    table.revenue-table tr:hover {
        background-color: #ddd;
    }

    table.revenue-table td {
        font-size: 14px;
    }

    table.revenue-table th {
        font-size: 16px;
    }

    table.revenue-table td,
    table.revenue-table th {
        border: 1px solid #ddd;
    }
</style>
