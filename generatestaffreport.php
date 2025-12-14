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

// SQL query to fetch attendance records
$sql = "SELECT * FROM attendence";
$result = $conn->query($sql);

// Check if there are records and display them in an HTML table format
if ($result->num_rows > 0) {
    echo "<table border='1' cellpadding='10' cellspacing='0'>";
    echo "<thead><tr><th>Staff ID</th><th>Date</th><th>In Time</th><th>Out Time</th></tr></thead>";
    echo "<tbody>";
    while($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . htmlspecialchars($row["empid"]) . "</td>";
        echo "<td>" . htmlspecialchars($row["date"]) . "</td>";
        echo "<td>" . htmlspecialchars($row["intime"]) . "</td>";
        echo "<td>" . htmlspecialchars($row["outtime"]) . "</td>";
        echo "</tr>";
    }
    echo "</tbody>";
    echo "</table>";
} else {
    echo "No attendance records found.";
}



// Close the database connection
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Generate Staff Report</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            background-color: #f7f7f7;
        }
        form {
            max-width: 600px;
            margin: auto;
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        h2 {
            text-align: center;
            color: #333;
        }
        label {
            display: block;
            margin: 10px 0 5px;
            font-weight: bold;
        }
        input, select, textarea {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        button {
            background-color: #4CAF50;
            color: white;
            border: none;
            padding: 10px 15px;
            cursor: pointer;
            border-radius: 4px;
        }
        button:hover {
            background-color: #45a049;
        }
        .error {
            color: red;
            font-size: 0.9em;
        }
    </style>
</head>
<body>
    <form id="staffReportForm" method="post" action="generatestaff.php">
        <h2>Generate Staff Report</h2>
        <label for="staff_id">Staff ID:</label>
        <input type="text" id="staff_id" name="staff_id" placeholder="Enter Staff ID" required>
        
        <label for="staff_name">Staff Name:</label>
        <input type="text" id="staff_name" name="staff_name" placeholder="Enter Staff Name" required>

        <label for="date">Date:</label>
        <input type="date" id="date" name="date" required>
        
        <label for="attendance_status">Attendance Status:</label>
        <select id="attendance_status" name="attendance_status" required>
            <option value="">Select Attendance Status</option>
            <option value="Present">Present</option>
            <option value="Absent">Absent</option>
            <option value="Late">Late</option>
        </select>
        
        <label for="comments">Comments:</label>
        <textarea id="comments" name="comments" rows="5" placeholder="Write comments or feedback..."></textarea>
        
        <button type="submit">Submit Report</button>
    </form>

    <script>
        $(document).ready(function () {
            $("#staffReportForm").on("submit", function (e) {
                let isValid = true;

                // Clear previous errors
                $(".error").remove();

                // Validate Staff ID
                if ($("#staff_id").val().trim() === "") {
                    $("#staff_id").after("<span class='error'>Staff ID is required.</span>");
                    isValid = false;
                }

                // Validate Staff Name
                if ($("#staff_name").val().trim() === "") {
                    $("#staff_name").after("<span class='error'>Staff Name is required.</span>");
                    isValid = false;
                }

                // Validate Attendance Status
                if ($("#attendance_status").val() === "") {
                    $("#attendance_status").after("<span class='error'>Please select attendance status.</span>");
                    isValid = false;
                }

                if (!isValid) {
                    e.preventDefault();
                }
            });
        });
    </script>
</body>
</html>
