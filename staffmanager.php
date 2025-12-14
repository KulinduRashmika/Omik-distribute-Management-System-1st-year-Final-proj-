<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
        body {
                        font-family: Arial, sans-serif;
            background-image: url('login2.jpg'); 
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .login-container {
            background-color: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            max-width: 400px;
            width: 100%;
        }
        h2 {
            text-align: center;
            margin-bottom: 30px;
            color: #4CAF50;
        }
        label {
            font-weight: bold;
            display: block;
            margin-bottom: 8px;
            color: #333;
        }
        input[type="text"],
        input[type="password"] {
            width: 100%;
            padding: 12px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
            font-size: 16px;
        }
        button[type="submit"] {
            width: 100%;
            background-color: #4CAF50;
            color: white;
            padding: 12px;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        button[type="submit"]:hover {
            background-color: #45a049;
        }
        .msg {
            text-align: center;
            margin-top: 10px;
            padding: 10px;
            border-radius: 5px;
        }
        .success {
           
            color: green;
        }
        .error {
            
            color: red;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <h2>Login</h2>
        <form action="" method="post">
            <label for="id">User ID:</label>
            <input type="text" id="id" name="id" required>

            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>

            <button type="submit">Login</button>
        </form>
        <div id="msg" class="msg"></div> <!-- Message container -->
    </div>


    <script>
        function showMessage(message, type) {
            var msgDiv = document.getElementById('msg');
            msgDiv.innerHTML = message;
            msgDiv.className = 'msg ' + type;
        }
    </script>
</body>
</html>

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

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = mysqli_real_escape_string($conn, $_POST['id']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    $sql = "SELECT * FROM staff_manager WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $id); // Changed "i" to "s" for string
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        // For plain text password check
        if ($password == $row['password']) {
            // Successful login
            echo "<script>showMessage('Login successful! Redirecting...', 'success');</script>";

            session_start();
            $_SESSION['id'] = $row['id']; // Store user ID in session

            // Delay the redirect to allow the user to see the success message
            echo "<script>setTimeout(function(){ window.location.href = 'staffmanagerdashboard.html'; }, 2000);</script>";
        } else {
            // Incorrect password
            echo "<script>showMessage('Incorrect password.', 'error');</script>";
        }
    } else {
        // Invalid User ID
        echo "<script>showMessage('Invalid User ID.', 'error');</script>";
    }

    $stmt->close();
}

$conn->close();
?>
