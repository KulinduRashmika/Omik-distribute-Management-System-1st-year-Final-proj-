<?php
// Database connection
$servername = "localhost";  
$username = "root";         
$password = "";             
$dbname = "omik_distributor";  

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the form is submitted to update status
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update'])) {
    $sid = $_POST['sid'];
    $status = $_POST['status'];

    // Update the status in the database
    $sql = "UPDATE leavereq SET status=? WHERE sid=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("si", $status, $sid);

    if ($stmt->execute()) {
        echo "<p>Record updated successfully!</p>";
    } else {
        echo "Error: " . $stmt->error;
    }
}

// Fetch data from the 'leavereq' table
$sql = "SELECT sid, leavedate, enddate, reason, status FROM leavereq";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Leave Request Table</title>
    <style>
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
        .update-button {
            padding: 8px 12px;
            background-color: #28a745;
            color: white;
            border: none;
            cursor: pointer;
        }
    </style>
</head>
<body>

<h2>Leave Request Table</h2>

<form method="POST" action="">
    <table>
        <thead>
            <tr>
                <th>SID</th>
                <th>Leave Date</th>
                <th>End Date</th>
                <th>Reason</th>
                <th>Status</th>
                <th>Update</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row['sid'] . "</td>";
                    echo "<td>" . $row['leavedate'] . "</td>";
                    echo "<td>" . $row['enddate'] . "</td>";
                    echo "<td>" . $row['reason'] . "</td>";
                    echo "<td>
                        <select name='status'>
                            <option value='approved' " . ($row['status'] === 'approved' ? 'selected' : '') . ">Approved</option>
                            <option value='not approved' " . ($row['status'] === 'not approved' ? 'selected' : '') . ">Not Approved</option>
                        </select>
                    </td>";
                    echo "<td>
                        <input type='hidden' name='sid' value='" . $row['sid'] . "'>
                        <button type='submit' name='update' class='update-button'>Update</button>
                    </td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='6'>No records found.</td></tr>";
            }
            ?>
        </tbody>
    </table>
</form>

<?php
// Close connection
$conn->close();
?>

</body>
</html>
