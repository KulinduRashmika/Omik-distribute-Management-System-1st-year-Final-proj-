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
    if (isset($_POST['update_approval'])) {
        $discountID = $_POST['discountID'];
        $approval = $_POST['approval'];

        $sql = "UPDATE discounts SET approval = ? WHERE discountID = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("si", $approval, $discountID);

        if ($stmt->execute()) {
            echo "<p class='success'>Approval status updated successfully.</p>";
        } else {
            echo "<p class='error'>Error: " . $stmt->error . "</p>";
        }
        $stmt->close();
    }
}

// Fetch all records
$sql = "SELECT * FROM discounts";
$result = $conn->query($sql);

// Add CSS styling
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
            background-color: #f9f9f9;
        }
        tr:hover {
            background-color: #f1f1f1;
        }
        form {
            display: flex;
            align-items: center;
        }
        select {
            padding: 5px;
            margin-right: 10px;
        }
        button {
            padding: 6px 12px;
            background-color: #4CAF50;
            color: white;
            border: none;
            cursor: pointer;
        }
        button:hover {
            background-color: #45a049;
        }
        .success {
            color: green;
            font-weight: bold;
            margin: 10px 0;
        }
        .error {
            color: red;
            font-weight: bold;
            margin: 10px 0;
        }
      </style>";

// Display the table
echo "<table>";
echo "<tr><th>Discount ID</th><th>Product Name</th><th>Original Price</th><th>Discount Amount</th><th>Start Date</th><th>End Date</th><th>Discounted Price</th><th>Approval</th></tr>";

while ($row = $result->fetch_assoc()) {
    echo "<tr>";
    echo "<td>" . $row['discountID'] . "</td>";
    echo "<td>" . $row['productName'] . "</td>";
    echo "<td>" . $row['originalPrice'] . "</td>";
    echo "<td>" . $row['discountAmount'] . "</td>";
     echo "<td>" . $row['startDate'] . "</td>";
    echo "<td>" . $row['endDate'] . "</td>";
    echo "<td>" . $row['discountedPrice'] . "</td>";
   

    // Display the current approval status and a dropdown to update it
    echo "<td>
            <form method='post' action=''>
                <select name='approval'>
                    <option value='Approved'" . ($row['approval'] == 'Approved' ? ' selected' : '') . ">Approved</option>
                    <option value='Not Approved'" . ($row['approval'] == 'Not Approved' ? ' selected' : '') . ">Not Approved</option>
                </select>
                <input type='hidden' name='discountID' value='" . $row['discountID'] . "'>
                <button type='submit' name='update_approval'>Update</button>
            </form>
          </td>";
    echo "</tr>";
}

echo "</table>";

$conn->close();
?>
