<?php
// Database connection
$connection = new mysqli('localhost', 'root', '', 'omik_distributor');

if ($connection->connect_error) {
    die('Database connection failed: ' . $connection->connect_error);
}

// Query to fetch all orders from the database
$query = "SELECT * FROM suporder";
$result = $connection->query($query);

// Display rows as HTML
while ($row = $result->fetch_assoc()) {
    echo "<tr>";
    echo "<td>" . $row['suporderid'] . "</td>";
    echo "<td>" . $row['ordername'] . "</td>";
    echo "<td>" . $row['amount'] . "</td>";

    // Display the status dropdown with the current value selected
    echo "<td>
        <select class='updateStatus' data-suporderid='" . $row['suporderid'] . "'>
            <option value='Pending'" . ($row['status'] == 'Pending' ? ' selected' : '') . ">Pending</option>
            <option value='Shipped'" . ($row['status'] == 'Shipped' ? ' selected' : '') . ">Shipped</option>
            <option value='Delivered'" . ($row['status'] == 'Delivered' ? ' selected' : '') . ">Delivered</option>
        </select>
    </td>";

    echo "<td>" . $row['qty'] . "</td>";
    echo "</tr>";
}

$connection->close();
?>
