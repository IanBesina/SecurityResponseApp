<?php
// Database connection
$conn = new mysqli("localhost", "dbuser", "dbpassword", "dbname");

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Query to retrieve the last row's Latitude and Longitude from the 'Incidence' table
$result = $conn->query("SELECT Latitude, Longitude FROM Incidence ORDER BY DateTime DESC LIMIT 1");
if ($result->num_rows > 0) {
    // Fetch the result as an associative array
    $row = $result->fetch_assoc();

    // Output the Latitude and Longitude
    $latitude = $row['Latitude'];
    $longitude = $row['Longitude'];
    
    echo "$latitude, $longitude";
} else {
    echo "No results found.";
}

// Close the connection
$conn->close();
?>
