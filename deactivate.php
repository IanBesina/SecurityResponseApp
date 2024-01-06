<?php
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    // Check if required parameter "MobileNumber" is set
    if (isset($_GET['MobileNumber'])) {
        // Retrieve form data
        $MobileNumber = $_GET['MobileNumber'];

        // Database connection
        $conn = new mysqli("localhost", "db_user", "db_password!", "dbname");

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Use prepared statement to prevent SQL injection
        $sql = $conn->prepare("DELETE FROM Users WHERE MobileNumber = ?");
        $sql->bind_param("s", $MobileNumber);

        if ($sql->execute()) {
            // Check if any rows were affected
            if ($sql->affected_rows > 0) {
                echo 'User Deactivated Successfully';
            } else {
                echo 'No records found for the given Mobile Number.';
            }
        } else {
            echo 'Error: ' . $sql->error;
        }

        // Close connection
        $sql->close();
        $conn->close();
    } else {
        echo 'Required: Mobile Number.';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Deactivate User</title>
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
    <form action="deactivate.php" method="get">
        <label for="MobileNumber">Enter Mobile Number:</label>
        <input type="text" id="MobileNumber" name="MobileNumber" required>
        <button type="submit">Deactivate User</button>
    </form>
    <center><a href="http://secapp.qooarx.com/monitor.php">Go back to Admin Panel</a></center>
</body>
</html>

