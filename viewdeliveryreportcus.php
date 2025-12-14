<?php
// Database configuration
$host = 'localhost';
$dbname = 'omik_distributor';
$username = 'root'; 
$password = '';     

try {
    // Connect to the database
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    

    // Get the payroll ID from the form or after the update
    if (isset($_GET['deliveryid']) || isset($_POST['deliveryid'])) {
        $deliveryid = isset($_GET['deliveryid']) ? $_GET['deliveryid'] : $_POST['deliveryid'];

        // Query to fetch payroll details
        $stmt = $conn->prepare("SELECT * FROM deliveryreport WHERE deliveryid = :deliveryid");
        $stmt->bindParam(':deliveryid', $deliveryid, PDO::PARAM_INT);
        $stmt->execute();

        // Check if records are found
        if ($stmt->rowCount() > 0) {
            $deliveryreport = $stmt->fetch(PDO::FETCH_ASSOC);

            // HTML with table styling
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
            echo '<body>';
            echo '<div class="container">';
            echo '<h1>Delivery Report Details</h1>';
            echo '<form method="POST" action="viewdeliveryreporttable.php">';
            echo '<table>';
            echo '<tr><th>Delivery ID</th><td>' . $deliveryreport['deliveryid'] . '</td></tr>';
            echo '<tr><th>Customer ID</th><td>' . $deliveryreport['customerid'] . '</td></tr>';
            echo '<tr><th>Delivery Address</th><td>' . $deliveryreport['deliveryadd'] . '</td></tr>';
            echo '<tr><th>Delivery Date</th><td>' . $deliveryreport['deliverydate'] . '</td></tr>';
            echo '<tr><th>Delivery Cost</th><td>' . $deliveryreport['deliverycost'] . '</td></tr>';
            echo '<tr><th>Status</th><td>' . $deliveryreport['status'] . '</td></tr>';
           
            
            
           
            echo '</table>';
           
            echo '</form>';

            // Back button to go to the previous page
            echo '<br>';
            echo '<form action="customerdashboard.html" method="GET">';
            echo '<button type="submit" class="back-button">Back</button>';
            echo '</form>';

            echo '</div>';
            echo '</body>';
            echo '</html>';
        } else {
            echo '<p>No Delivery Report found with ID ' . htmlspecialchars($deliveryid) . '.</p>';
        }
    } else {
        echo '<p>Delivery Report ID is required.</p>';
    }
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>
