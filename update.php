<?php
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    // Check if required parameters are set
    if (isset($_GET['DateTime'], $_GET['Details'])) {
        // Retrieve form data
        $DateTime = $_GET['DateTime'];
        $Details = $_GET['Details'];

        // Database connection
        $conn = new mysqli("localhost", "db_user", "db_password", "dbname");

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Use prepared statement to prevent SQL injection
        $sql = $conn->prepare("UPDATE Incidence SET Details = ? WHERE DateTime = ?");
        $sql->bind_param("ss", $Details, $DateTime);

        if ($sql->execute()) {
            // Check if any rows were affected
            if ($sql->affected_rows > 0) {
                echo 'Details updated successfully!';
            } else {
                echo 'No records found for the given DateTime.';
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
