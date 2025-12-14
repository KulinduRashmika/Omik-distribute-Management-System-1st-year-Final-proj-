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

// SQL query to fetch data from the staff_report table
$sql = "SELECT * FROM staff_report";
$result = $conn->query($sql);

// Display the heading and table
echo "<h1 class='page-heading'>Staff Report</h1>";
echo "<table class='staff-table'>";
echo "<tr><th>Staff ID</th><th>Staff Name</th><th>Date</th><th>Attendance Status</th><th>Comments</th></tr>";

while ($row = $result->fetch_assoc()) {
    echo "<tr>";
    echo "<td>" . $row['staff_id'] . "</td>";
    echo "<td>" . $row['staff_name'] . "</td>";
    echo "<td>" . $row['date'] . "</td>";
    echo "<td>" . $row['attendance_status'] . "</td>";
    echo "<td>" . $row['comments'] . "</td>";
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

    table.staff-table {
        width: 80%;
        max-width: 900px;
        margin-top: 20px;
        border-collapse: collapse;
        background-color: #fff;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    table.staff-table th,
    table.staff-table td {
        padding: 12px;
        text-align: center;
        border: 1px solid #ddd;
    }

    table.staff-table th {
        background-color: #4CAF50;
        color: white;
    }

    table.staff-table tr:nth-child(even) {
        background-color: #f2f2f2;
    }

    table.staff-table tr:hover {
        background-color: #ddd;
    }

    table.staff-table td {
        font-size: 14px;
    }

    table.staff-table th {
        font-size: 16px;
    }

    table.staff-table td,
    table.staff-table th {
        border: 1px solid #ddd;
    }
</style>
