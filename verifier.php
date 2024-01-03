<?php
// Database connection
$conn = new mysqli("localhost", "db_user", "db_password", "dbname");

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch all entries from the Incidence table
$result = $conn->query("SELECT IsActive FROM Users WHERE PIN = ?");
echo $result;

// Close database connection
$conn->close();
?>

