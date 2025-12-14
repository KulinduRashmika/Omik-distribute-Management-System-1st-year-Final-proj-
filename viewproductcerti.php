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

// SQL query to fetch data from the productcertification table
$sql = "SELECT * FROM productcertification";
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
echo "<tr><th>Product ID</th><th>Product Name</th><th>Price</th><th>Product Certificate</th></tr>";

while ($row = $result->fetch_assoc()) {
    echo "<tr>";
    
    echo "<td>" . $row['productid'] . "</td>";
    echo "<td>" . $row['pname'] . "</td>";
    echo "<td>" . $row['price'] . "</td>";
    echo "<td>" . $row['productcertificat'] . "</td>";
    echo "</tr>";
}

echo "</table>";
echo "</div>";

$conn->close();
?>
