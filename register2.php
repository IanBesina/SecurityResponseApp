<?php
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    // Check if required parameters are set
    if (isset($_GET['PIN'], $_GET['IsActive'])) {
        // Retrieve form data
        $PIN = $_GET['PIN'];
        $IsActive = $_GET['IsActive'];

        // Database connection
        $conn = new mysqli("localhost", "db_user", "db_password", "dbname");

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Use prepared statement to prevent SQL injection
        $sql = $conn->prepare("UPDATE Users SET IsActive = ? WHERE PIN = ?");
        $sql->bind_param("ss", $IsActive, $PIN);

        if ($sql->execute()) {
            // Check if any rows were affected
            if ($sql->affected_rows > 0) {
                echo 'Registration complete';
            } else {
                echo 'No records found for the given PIN.';
            }
        } else {
            echo 'Error: ' . $sql->error;
        }

        // Close connection
        $sql->close();
        $conn->close();
    } else {
        echo 'Missing required parameters.';
    }
}
?>
