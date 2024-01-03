<?php
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    // Check if PIN is set
    if (isset($_GET['PIN'])) {
        // Retrieve form data
        $PIN = $_GET['PIN'];
        
        // Set default values if not provided
        $Name = isset($_GET['Name']) ? $_GET['Name'] : 'None';
        $Age = isset($_GET['Age']) ? $_GET['Age'] : '1';
        $Gender = isset($_GET['Gender']) ? $_GET['Gender'] : 'None';
        $MobileNumber = isset($_GET['MobileNumber']) ? $_GET['MobileNumber'] : '0';
        $IsActive = isset($_GET['IsActive']) ? $_GET['IsActive'] : 'False';
        
        // Database connection
        $conn = new mysqli("localhost", "db_user", "db_password", "dbname");

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Use prepared statement to prevent SQL injection
        $sql = $conn->prepare("INSERT INTO Users (PIN, Name, Age, Gender, MobileNumber, IsActive) VALUES (?, ?, ?, ?, ?, ?)");
        $sql->bind_param("ssssss", $PIN, $Name, $Age, $Gender, $MobileNumber, $IsActive);

        if ($sql->execute()) {
            echo 'PIN Number has been reserved';
        } else {
            echo 'Error: ' . $sql->error;
        }

        // Close connection
        $sql->close();
        $conn->close();
    } else {
        echo 'Missing required parameter: PIN.';
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reserve PIN</title>
    <style>
        body {
            background-color: #F44336FF;
            color: white;
        }

        form {
            margin: 20px;
        }

        label, input, button {
            display: block;
            margin-bottom: 10px;
        }

        button {
            background-color: #2196F3;
            color: white;
            padding: 5px 10px;
            border: none;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <form action="reserve.php" method="get">
        <label for="PIN">Enter PIN:</label>
        <input type="text" id="PIN" name="PIN" required>
        <button type="submit">Reserve PIN</button>
    </form>
    <center><a href="http://secapp.qooarx.com/monitor.php">Go back to Admin Panel</a></center>
</body>
</html>
