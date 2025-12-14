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

// Handle form submissions for adding, updating, and deleting records
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Add a new record
    if (isset($_POST['add'])) {
        $suporderid = htmlspecialchars(trim($_POST['suporderid']));
        $ordername = htmlspecialchars(trim($_POST['ordername']));
        $amount = filter_var($_POST['amount'], FILTER_VALIDATE_FLOAT);
        $qty = filter_var($_POST['qty'], FILTER_VALIDATE_INT);

        if ($amount === false || $qty === false) {
            echo "Invalid amount or quantity.";
        } else {
            $sql = "INSERT INTO suporder (suporderid, ordername, amount, qty) VALUES (?, ?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ssdi", $suporderid, $ordername, $amount, $qty);

            if ($stmt->execute()) {
                echo "New record added successfully.";
                header("Location: placesupporder.php");
                exit;
            } else {
                echo "Error: " . $stmt->error;
            }
            $stmt->close();
        }
    }

    // Update a record
    if (isset($_POST['update'])) {
        $suporderid = htmlspecialchars(trim($_POST['suporderid']));
        $ordername = htmlspecialchars(trim($_POST['ordername']));
        $amount = filter_var($_POST['amount'], FILTER_VALIDATE_FLOAT);
        $qty = filter_var($_POST['qty'], FILTER_VALIDATE_INT);

        if ($amount === false || $qty === false) {
            echo "Invalid amount or quantity.";
        } else {
            $sql = "UPDATE suporder SET ordername = ?, amount = ?, qty = ? WHERE suporderid = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("sdii", $ordername, $amount, $qty, $suporderid);

            if ($stmt->execute()) {
                echo "Record updated successfully.";
                header("Location: placesupporder.php");
                exit;
            } else {
                echo "Error: " . $stmt->error;
            }
            $stmt->close();
        }
    }

    // Delete a record
    if (isset($_POST['delete'])) {
        $suporderid = htmlspecialchars(trim($_POST['suporderid']));

        $sql = "DELETE FROM suporder WHERE suporderid = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $suporderid);

        if ($stmt->execute()) {
            echo "Record deleted successfully.";
            header("Location: placesupporder.php"); // Refresh the page to show updated table
            exit;
        } else {
            echo "Error: " . $stmt->error;
        }
        $stmt->close();
    }
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
        .action-btn {
            padding: 5px 10px;
            color: white;
            background-color: #4CAF50;
            border: none;
            cursor: pointer;
        }
        .action-btn:hover {
            background-color: #45a049;
        }
        .delete-btn {
            padding: 5px 10px;
            color: white;
            background-color: #e74c3c;
            border: none;
            cursor: pointer;
        }
        .delete-btn:hover {
            background-color: #c0392b;
        }
    </style>";

echo "<div class='table-container'>";
echo "<table>";
echo "<tr><th>Supplier Order ID</th><th>Order Name</th><th>Unit Price</th><th>Quantity</th><th>Actions</th></tr>";

while ($row = $result->fetch_assoc()) {
    echo "<tr id='row_" . $row['suporderid'] . "'>";
    echo "<td><input type='text' name='suporderid' value='" . $row['suporderid'] . "' disabled></td>";
    echo "<td><input type='text' name='ordername' value='" . $row['ordername'] . "'></td>";
    echo "<td><input type='number' name='amount' value='" . $row['amount'] . "' step='0.01'></td>";
    echo "<td><input type='number' name='qty' value='" . $row['qty'] . "'></td>";
    echo "<td>
            <form method='post' style='display:inline;'>
                <input type='hidden' name='suporderid' value='" . $row['suporderid'] . "'>
                <input type='text' name='ordername' value='" . $row['ordername'] . "'>
                <input type='number' name='amount' value='" . $row['amount'] . "' step='0.01'>
                <input type='number' name='qty' value='" . $row['qty'] . "'>
                <input type='submit' name='update' value='Update' class='action-btn'>
                <input type='submit' name='delete' value='Delete' class='delete-btn'>
            </form>
          </td>";
    echo "</tr>";
}

echo "</table>";
echo "</div>";

$conn->close();
?>
