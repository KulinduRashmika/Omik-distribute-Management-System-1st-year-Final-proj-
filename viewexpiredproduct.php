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

// Initialize message
$message = "";

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $productid = $_POST['productid'];

    // Fetch expired products from the expireproducts table based on productid
    $sql = "SELECT * FROM expireproducts WHERE productid = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $productid);
    $stmt->execute();
    $result = $stmt->get_result();

    echo '<!DOCTYPE html>';
    echo '<html lang="en">';
    echo '<head>';
    echo '<meta charset="UTF-8">';
    echo '<meta name="viewport" content="width=device-width, initial-scale=1.0">';
    echo '<title>Delivery Report Details</title>';
    echo '<style>
            body {
                font-family: Arial, sans-serif;
                background-color: #f4f4f4;
                margin: 0;
                padding: 20px;
                display: flex;
                justify-content: center;
                align-items: center;
                height: 100vh;
            }
            .container {
                background-color: white;
                padding: 20px;
                border-radius: 10px;
                box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
                width: 80%;
                max-width: 600px;
            }
            h1 {
                text-align: center;
                color: #333;
            }
            table {
                width: 100%;
                border-collapse: collapse;
                margin-top: 20px;
            }
            th, td {
                padding: 12px 15px;
                border: 1px solid #ddd;
                text-align: left;
            }
            th {
                background-color: #f2f2f2;
                color: #333;
                text-transform: uppercase;
                font-size: 14px;
            }
            tr:nth-child(even) {
                background-color: #f9f9f9;
            }
            tr:hover {
                background-color: #f1f1f1;
            }
            td {
                color: #555;
                font-size: 14px;
            }
            button {
                padding: 10px 20px;
                background-color: #0056b3;
                color: white;
                border: none;
                border-radius: 5px;
                font-size: 16px;
                cursor: pointer;
            }
            button:hover {
                background-color: #003d80;
            }
            .back-button {
                margin-top: 20px;
                background-color: #333;
                color: white;
            }
          </style>';
    echo '</head>';

    // Check if expired products are found
    if ($result->num_rows > 0) {
        // Display expired products in a table
        echo "<table>";
        echo "<thead><tr><th>Product ID</th><th>Quantity</th><th>Amount</th><th>Total Amount</th></tr></thead>";
        echo "<tbody>";

        while ($row = $result->fetch_assoc()) {
            // Calculate total amount
            $totamount = $row['quantity'] * $row['amount'];

            echo "<tr>";
            echo "<td>" . $row['productid'] . "</td>";
            echo "<td>" . $row['quantity'] . "</td>";
            echo "<td>" . $row['amount'] . "</td>";
            echo "<td>" . $totamount . "</td>"; // Display total amount
            echo "</tr>";
        }

        echo "</tbody>";
        echo "</table>";
    } else {
        echo "<p>No expired products found for this Product ID.</p>";
    }

    $stmt->close();
}

$conn->close();
?>
