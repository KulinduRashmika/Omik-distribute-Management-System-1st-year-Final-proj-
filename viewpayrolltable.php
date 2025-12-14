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

    // Check if the form has been submitted for status update
    if (isset($_POST['update_status'])) {
        $payrollid = $_POST['payrollid'];
        $newStatus = $_POST['status'];

        // Update payroll status in the database
        $updateStmt = $conn->prepare("UPDATE payroll SET status = :status WHERE payrollid = :payrollid");
        $updateStmt->bindParam(':status', $newStatus);
        $updateStmt->bindParam(':payrollid', $payrollid, PDO::PARAM_INT);
        $updateStmt->execute();

        echo "<script>alert('Status updated successfully');</script>";
    }

    // Get the payroll ID from the form or after the update
    if (isset($_GET['payrollid']) || isset($_POST['payrollid'])) {
        $payrollid = isset($_GET['payrollid']) ? $_GET['payrollid'] : $_POST['payrollid'];

        // Query to fetch payroll details
        $stmt = $conn->prepare("SELECT * FROM payroll WHERE payrollid = :payrollid");
        $stmt->bindParam(':payrollid', $payrollid, PDO::PARAM_INT);
        $stmt->execute();

        // Check if records are found
        if ($stmt->rowCount() > 0) {
            $payroll = $stmt->fetch(PDO::FETCH_ASSOC);

            // HTML with table styling
            echo '<!DOCTYPE html>';
            echo '<html lang="en">';
            echo '<head>';
            echo '<meta charset="UTF-8">';
            echo '<meta name="viewport" content="width=device-width, initial-scale=1.0">';
            echo '<title>Payroll Details</title>';
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
            echo '<h1>Payroll Details</h1>';
            echo '<form method="POST" action="viewpayrolltable.php">';
            echo '<table>';
            echo '<tr><th>Payroll ID</th><td>' . $payroll['payrollid'] . '</td></tr>';
            echo '<tr><th>Month</th><td>' . $payroll['month'] . '</td></tr>';
            echo '<tr><th>Acc No</th><td>' . $payroll['accno'] . '</td></tr>';
            echo '<tr><th>Basic Salary</th><td>' . $payroll['basic'] . '</td></tr>';
            echo '<tr><th>ETF</th><td>' . $payroll['etf'] . '</td></tr>';
            echo '<tr><th>Total Salary</th><td>' . $payroll['totsalary'] . '</td></tr>';
            echo '<tr><th>Status</th><td>';
            echo '<select name="status">';
            echo '<option value="Paid"' . ($payroll['status'] == 'Paid' ? ' selected' : '') . '>Paid</option>';
            echo '<option value="Not Paid"' . ($payroll['status'] == 'Not Paid' ? ' selected' : '') . '>Not Paid</option>';
            echo '</select>';
            echo '</td></tr>';
            echo '</table>';
            echo '<br>';
            echo '<input type="hidden" name="payrollid" value="' . $payroll['payrollid'] . '">';
            echo '<button type="submit" name="update_status">Update Status</button>';
            echo '</form>';

            // Back button to go to the previous page
            echo '<br>';
            echo '<form action="accountantdashboard.html" method="GET">';
            echo '<button type="submit" class="back-button">Back</button>';
            echo '</form>';

            echo '</div>';
            echo '</body>';
            echo '</html>';
        } else {
            echo '<p>No payroll found with ID ' . htmlspecialchars($payrollid) . '.</p>';
        }
    } else {
        echo '<p>Payroll ID is required.</p>';
    }
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>
