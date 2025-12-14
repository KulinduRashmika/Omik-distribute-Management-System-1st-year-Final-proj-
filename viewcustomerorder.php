<?php
$conn = new mysqli("localhost", "root", "", "omik_distributor");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM cusorder WHERE approvestatus = 'Approved'";
$result = $conn->query($sql);

// Error handling for query execution
if ($result === false) {
    die("Error: " . $conn->error);
}

if ($result->num_rows > 0) {
    // Styling for table
    echo "<style>
            table {
                width: 100%;
                border-collapse: collapse;
            }
            th, td {
                padding: 10px;
                text-align: left;
                border: 1px solid #ddd;
            }
            th {
                background-color: #f2f2f2;
            }
            tr:nth-child(even) {
                background-color: #f9f9f9;
            }
            .status {
                color: #2ecc71;
            }
          </style>";

    echo "<table>";
    echo "<tr><th>Customer ID</th><th>Address</th><th>Approve Status</th><th>Load</th><th>Delivery Status</th></tr>";
    
    while ($row = $result->fetch_assoc()) {
        echo "<tr class='order-row' data-cusid='" . $row['cusid'] . "'>";
        echo "<td>" . $row['cusid'] . "</td>";
        echo "<td>" . $row['address'] . "</td>";
        echo "<td>" . $row['approvestatus'] . "</td>";
        echo "<td>" . $row['load'] . "</td>";
        echo "<td class='status'>" . $row['deliverystatus'] . "</td>";
        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "No approved orders found.";
}

$conn->close();
?>
