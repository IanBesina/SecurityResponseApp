<?php
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    // Check if all required parameters are set
    if (isset($_GET['DateTime'], $_GET['Latitude'], $_GET['Longitude'], $_GET['Name'], $_GET['Age'], $_GET['Gender'], $_GET['MobileNumber'], $_GET['Status'], $_GET['TimeFlagged'], $_GET['Details'])) {
        // Retrieve form data
        $DateTime = $_GET['DateTime'];
        $Latitude = $_GET['Latitude'];
        $Longitude = $_GET['Longitude'];
        $Name = $_GET['Name'];
        $Age = $_GET['Age'];
        $Gender = $_GET['Gender'];
        $MobileNumber = $_GET['MobileNumber'];
        $Status = $_GET['Status'];
        $TimeFlagged = $_GET['TimeFlagged'];
        $Details = $_GET['Details'];

        // Database connection
        $conn = new mysqli("localhost", "db_user", "db_password", "dbname");

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Use prepared statement to prevent SQL injection
        $sql = $conn->prepare("INSERT INTO Incidence (DateTime, Latitude, Longitude, Name, Age, Gender, MobileNumber, Status, TimeFlagged, Details) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $sql->bind_param("ssssssssss", $DateTime, $Latitude, $Longitude, $Name, $Age, $Gender, $MobileNumber, $Status, $TimeFlagged, $Details);

        if ($sql->execute()) {
            echo 'Incident has been reported and help is on the way!';
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
