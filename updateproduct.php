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
    if (isset($_POST['update_product'])) {
        $pid = $_POST['pid'];
        $pname = $_POST['pname'];
        $price = $_POST['price'];
        $stockqty = $_POST['stockqty'];
        $status = $_POST['status'];

        // Update the product data
        $sql = "UPDATE products SET pname = ?, price = ?, stockqty = ?, status = ? WHERE pid = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sdisi", $pname, $price, $stockqty, $status, $pid);

        if ($stmt->execute()) {
            echo "<p>Product updated successfully!</p>";
        } else {
            echo "<p>Error: " . $stmt->error . "</p>";
        }

        $stmt->close();
    }
}

// Fetch all products
$sql = "SELECT * FROM products";
$result = $conn->query($sql);

// Display the table
echo "<table class='product-table'>";
echo "<tr><th>PID</th><th>Product Name</th><th>Price</th><th>Stock Quantity</th><th>Status</th><th>Action</th></tr>";

while ($row = $result->fetch_assoc()) {
    echo "<tr>";
    echo "<td>" . $row['pid'] . "</td>";
    echo "<td>" . $row['pname'] . "</td>";
    echo "<td>" . $row['price'] . "</td>";
    echo "<td>" . $row['stockqty'] . "</td>";
    echo "<td>" . $row['status'] . "</td>";
    echo "<td>
            <form method='post' action=''>
                <input type='hidden' name='pid' value='" . $row['pid'] . "'>
                <input type='text' name='pname' value='" . $row['pname'] . "'>
                <input type='number' name='price' value='" . $row['price'] . "'>
                <input type='number' name='stockqty' value='" . $row['stockqty'] . "'>
                <input type='text' name='status' value='" . $row['status'] . "'>
                <button type='submit' name='update_product'>Update</button>
            </form>
        </td>";
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
    }

    table.product-table {
        width: 80%;
        max-width: 1200px;
        margin: 20px 0;
        border-collapse: collapse;
        background-color: #fff;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    table.product-table th,
    table.product-table td {
        padding: 10px;
        text-align: center;
        border: 1px solid #ddd;
    }

    table.product-table th {
        background-color: #4CAF50;
        color: white;
    }

    form {
        display: flex;
        flex-direction: column;
        gap: 10px;
    }

    input[type="text"], input[type="number"] {
        padding: 8px;
        font-size: 14px;
        border: 1px solid #ccc;
        border-radius: 4px;
    }

    button {
        background-color: #4CAF50;
        color: white;
        border: none;
        padding: 10px;
        border-radius: 4px;
        cursor: pointer;
        font-size: 16px;
    }

    button:hover {
        background-color: #45a049;
    }

    p {
        text-align: center;
        font-size: 16px;
        color: green;
    }

    input[type="text"]:focus,
    input[type="number"]:focus {
        border-color: #4CAF50;
        outline: none;
    }
</style>
