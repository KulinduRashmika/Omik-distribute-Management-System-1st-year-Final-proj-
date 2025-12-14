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

// Handle form submissions
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['add'])) {
        // Sanitize and validate inputs
        $suporderid = htmlspecialchars(trim($_POST['suporderid']));
        $ordername = htmlspecialchars(trim($_POST['ordername']));
        $amount = filter_var($_POST['amount'], FILTER_VALIDATE_FLOAT);
        $qty = filter_var($_POST['qty'], FILTER_VALIDATE_INT);

        // Check if the inputs are valid
        if ($amount === false || $qty === false) {
            echo "Invalid amount or quantity.";
        } else {
            // Prepare and execute the INSERT query
            $sql = "INSERT INTO suporder (suporderid, ordername, amount, qty) VALUES (?, ?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ssdi", $suporderid, $ordername, $amount, $qty);

            if ($stmt->execute()) {
                echo "New record added successfully.";
                header("Location: placesupporder.php"); // Redirect to the main page
                exit; // Ensure no further code is executed after the redirect
            } else {
                echo "Error: " . $stmt->error;
            }
            $stmt->close();
        }
    }
    // Handle other form submissions (update, delete) here
}

// Fetch all records from the database
$sql = "SELECT * FROM suporder";
$result = $conn->query($sql);

// Display the table with styling
echo "<style>
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
            font-family: Arial, sans-serif;
        }
        th, td {
            padding: 10px;
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
        .table-container {
            max-width: 800px;
            margin: auto;
            overflow-x: auto;
        }
    </style>";

echo "<div class='table-container'>";
echo "<table>";
echo "<tr><th>Supplier Order ID</th><th>Order Name</th><th>Unit Price</th><th>Quantity</th></tr>";
while ($row = $result->fetch_assoc()) {
    echo "<tr>";
    echo "<td>" . $row['suporderid'] . "</td>";
    echo "<td>" . $row['ordername'] . "</td>";
    echo "<td>" . $row['amount'] . "</td>";
    echo "<td>" . $row['qty'] . "</td>";
    echo "</tr>";
}
echo "</table>";
echo "</div>";

$conn->close();
?>
