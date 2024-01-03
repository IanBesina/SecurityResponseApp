<?php
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if (isset($_GET['dateTime'])) {
        $dateTime = $_GET['dateTime'];

        // Database connection
        $conn = new mysqli("localhost", "db_user", "db_password", "dbname");
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Use prepared statement to prevent SQL injection
        $sql = $conn->prepare("UPDATE Incidence SET Status = 'Flagged', TimeFlagged = CURRENT_TIMESTAMP WHERE DateTime = ?");
        $sql->bind_param("s", $dateTime);

        if ($sql->execute()) {
            echo 'Incident flagged successfully.';
        } else {
            echo 'Error: ' . $sql->error;
        }

        // Close connection
        $sql->close();
        $conn->close();
    } else {
        echo 'Missing DateTime parameter.';
    }
} else {
    echo 'Invalid request method.';
}
?>
