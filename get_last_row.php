<?php
// Database connection
$conn = new mysqli("localhost", "db_user", "db_password", "dbname");

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch the last row from the Incidence table
$result = $conn->query("SELECT * FROM Incidence ORDER BY DateTime DESC LIMIT 1");

// Convert the result to JSON format
$rows = array();
while ($row = $result->fetch_assoc()) {
    $rows[] = $row;
}
echo json_encode($rows);

// Close database connection
$conn->close();
?>
