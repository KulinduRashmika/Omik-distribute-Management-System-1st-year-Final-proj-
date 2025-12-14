<?php
// Database connection
$conn = new mysqli("localhost", "root", "", "omik_distributor");

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch all customer orders
$sql = "SELECT * FROM cusorder";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View & Approve Customer Orders</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            background-color: #f5f5f5;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
            background-color: #fff;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }
        table, th, td {
            border: 1px solid #ccc;
        }
        th, td {
            padding: 10px;
            text-align: center;
        }
        th {
            background-color: #4CAF50;
            color: white;
        }
        .form-container {
            margin: auto;
            width: 80%;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            background-color: #fff;
        }
        button {
            padding: 8px 12px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        button:hover {
            background-color: #45a049;
        }
        .message {
            color: green;
            font-weight: bold;
            text-align: center;
            margin-top: 15px;
        }
    </style>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>

<div class="form-container">
    <h2>View & Approve Customer Orders</h2>
    <div class="message" id="form-message"></div>
    <table>
        <thead>
            <tr>
                <th>Customer ID</th>
                <th>Address</th>
                <th>Load</th>
                <th>Approval Status</th>
                <th>Delivery Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php if ($result && $result->num_rows > 0) { ?>
                <?php while ($row = $result->fetch_assoc()) { ?>
                    <tr>
                        <td><?php echo $row['cusid']; ?></td>
                        <td><?php echo $row['address']; ?></td>
                        <td><?php echo $row['load']; ?></td>
                        <td>
                            <select class="approvestatus" data-cusid="<?php echo $row['cusid']; ?>">
                                <option value="Pending" <?php echo ($row['approvestatus'] === "Pending" ? "selected" : ""); ?>>Pending</option>
                                <option value="Approved" <?php echo ($row['approvestatus'] === "Approved" ? "selected" : ""); ?>>Approved</option>
                                <option value="Rejected" <?php echo ($row['approvestatus'] === "Rejected" ? "selected" : ""); ?>>Rejected</option>
                            </select>
                        </td>
                        <td><?php echo $row['deliverystatus']; ?></td>
                        <td><button class="update-button" data-cusid="<?php echo $row['cusid']; ?>">Update</button></td>
                    </tr>
                <?php } ?>
            <?php } else { ?>
                <tr>
                    <td colspan="6">No orders found.</td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>

<script>
    $(document).ready(function () {
        $(".update-button").click(function () {
            const cusid = $(this).data("cusid");
            const approvestatus = $(this).closest("tr").find(".approvestatus").val();

            $.ajax({
                url: "updateapproveorderssalemanager.php",
                type: "POST",
                data: {
                    cusid: cusid,
                    approvestatus: approvestatus
                },
                success: function (response) {
                    $("#form-message").text(response).fadeIn().delay(3000).fadeOut();
                },
                error: function () {
                    $("#form-message").text("Error updating status.").fadeIn().delay(3000).fadeOut();
                }
            });
        });
    });
</script>

</body>
</html>

<?php
$conn->close();
?>
