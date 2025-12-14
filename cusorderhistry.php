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

// SQL query to fetch data from the cusorder table
$sql = "SELECT * FROM cusorder";
$result = $conn->query($sql);

// Adding table design with CSS
echo "<style>
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
            font-family: Arial, sans-serif;
        }
        th, td {
            padding: 12px;
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
        a {
            text-decoration: none;
            color: #4CAF50;
            font-weight: bold;
        }
        a:hover {
            color: #45a049;
        }
        .table-container {
            max-width: 1000px;
            margin: 20px auto;
        }
      </style>";

// Display the table
echo "<div class='table-container'>";
echo "<table>";
echo "<tr><th>cusid</th><th>address</th><th>load</th><th>approvestatus</th><th>deliverystatus</th></tr>";

while ($row = $result->fetch_assoc()) {
    echo "<tr>";
    
    echo "<td>" . $row['cusid'] . "</td>";
    echo "<td>" . $row['address'] . "</td>";
    echo "<td>" . $row['load'] . "</td>";
    echo "<td>" . $row['approvestatus'] . "</td>";
    echo "<td>" . $row['deliverystatus'] . "</td>";
    echo "</tr>";
}

echo "</table>";
echo "</div>";

$conn->close();
?>
