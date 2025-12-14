<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Task Management</title>
    <!-- Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS for table styling -->
    <style>
        body {
            margin: 20px;
            background-color: #f8f9fa;
        }
        .table-container {
            max-width: 1000px;
            margin: 0 auto;
        }
        table {
            background-color: #fff;
            border-collapse: collapse;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        th {
            background-color: #007bff;
            color: white;
        }
        td, th {
            padding: 10px;
            text-align: center;
        }
        .btn-primary {
            background-color: #28a745;
            border-color: #28a745;
        }
    </style>
</head>
<body>

<div class="table-container">
    <h2 class="text-center mb-4">Task Management</h2>
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

    // Check if the form has been submitted to update the task status
    if (isset($_POST['update_status'])) {
        $taskID = $_POST['task_id'];
        $newStatus = $_POST['status'];

        // Update the task status in the database
        $update_sql = "UPDATE tasks SET Status = ? WHERE TaskID = ?";
        $stmt = $conn->prepare($update_sql);
        $stmt->bind_param('si', $newStatus, $taskID);

        if ($stmt->execute()) {
            echo "<script>alert('Task status updated successfully');</script>";
        } else {
            echo "Error updating status: " . $conn->error;
        }
    }

    // Fetch all tasks from the database
    $sql = "SELECT * FROM tasks";
    $result = $conn->query($sql);

    // Check if there are any tasks
    if ($result->num_rows > 0) {
        echo '<table class="table table-bordered table-striped">';
        echo '<thead>';
        echo '<tr>';
        echo '<th>TaskID</th>';
        echo '<th>Task Name</th>';
        echo '<th>Start Date</th>';
        echo '<th>End Date</th>';
        echo '<th>Type</th>';
        echo '<th>Value</th>';
        echo '<th>Status</th>';
        echo '<th>Action</th>';
        echo '</tr>';
        echo '</thead>';
        echo '<tbody>';

        // Output data of each row
        while ($row = $result->fetch_assoc()) {
            echo '<tr>';
            echo '<td>' . htmlspecialchars($row['TaskID']) . '</td>';
            echo '<td>' . htmlspecialchars($row['TaskName']) . '</td>';
            echo '<td>' . htmlspecialchars($row['StartDate']) . '</td>';
            echo '<td>' . htmlspecialchars($row['EndDate']) . '</td>';
            echo '<td>' . htmlspecialchars($row['Type']) . '</td>';
            echo '<td>' . htmlspecialchars($row['Value']) . '</td>';

            // Create a form inside the table row for updating the status of each task
            echo '<form method="POST" action="">';

            // Combo box for status
            echo '<td>';
            echo '<select name="status" class="form-control">';
            echo '<option value="Done"' . ($row['Status'] == 'Done' ? ' selected' : '') . '>Done</option>';
            echo '<option value="Didn\'t"' . ($row['Status'] == "Didn't" ? ' selected' : '') . '>Didn\'t</option>';
            echo '</select>';
            echo '</td>';

            // Hidden input for TaskID and a button to update the status
            echo '<td>';
            echo '<input type="hidden" name="task_id" value="' . htmlspecialchars($row['TaskID']) . '">';
            echo '<button type="submit" name="update_status" class="btn btn-primary">Update</button>';
            echo '</td>';
            echo '</form>'; // Close the form for the current row

            echo '</tr>';
        }

        // End the table
        echo '</tbody>';
        echo '</table>';
    } else {
        echo '<p class="no-data text-center">No tasks found.</p>';
    }

    // Close the connection
    $conn->close();
    ?>
</div>

<!-- Bootstrap JS and dependencies -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>
