<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delivery Report</title>
    <!-- Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS for additional table styling -->
    <style>
        body {
            margin: 20px;
            background-color: #f8f9fa;
        }
        .table-container {
            max-width: 1200px;
            margin: 0 auto;
        }
        table {
            background-color: #fff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 5px;
        }
        th {
            background-color: #007bff;
            color: white;
        }
        td, th {
            padding: 10px;
            text-align: center;
        }
        .table-striped tbody tr:nth-of-type(odd) {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>

<div class="table-container">
    <h2 class="text-center mb-4">Delivery Report</h2>
    <?php
    // Database configuration
    $host = "localhost";
    $username = "root";
    $password = "";
    $dbname = "omik_distributor";

    // Create database connection
    $conn = new mysqli($host, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // SQL query to select all data from the 'deliveryreport' table
    $sql = "SELECT * FROM deliveryreport";
    $result = $conn->query($sql);

    // Check if there are any results
    if ($result->num_rows > 0) {
        echo "<table class='table table-bordered table-striped'>";
        echo "<thead>";
        echo "<tr>";
        echo "<th>Delivery ID</th>";
        echo "<th>Customer ID</th>";
        echo "<th>Delivery Address</th>";
        echo "<th>Delivery Date</th>";
        echo "<th>Delivery Cost</th>";
        echo "<th>Status</th>";
        echo "</tr>";
        echo "</thead>";
        echo "<tbody>";

        // Fetch and display each row of the delivery report
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . htmlspecialchars($row["deliveryid"]) . "</td>";
            echo "<td>" . htmlspecialchars($row["customerid"]) . "</td>";
            echo "<td>" . htmlspecialchars($row["deliveryadd"]) . "</td>";
            echo "<td>" . htmlspecialchars($row["deliverydate"]) . "</td>";
            echo "<td>" . htmlspecialchars($row["deliverycost"]) . "</td>";
            echo "<td>" . htmlspecialchars($row["status"]) . "</td>";
            echo "</tr>";
        }

        echo "</tbody>";
        echo "</table>";
    } else {
        echo "<div class='alert alert-warning text-center'>No delivery reports found.</div>";
    }

    // Close the database connection
    $conn->close();
    ?>
</div>

<!-- Bootstrap JS and dependencies -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>
