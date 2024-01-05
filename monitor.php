<?php
// Database connection
$conn = new mysqli("localhost", "db_user", "db_password", "dbname");

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch all entries from the Incidence table
$result = $conn->query("SELECT * FROM Incidence");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <style>
        body {
            background-color: #F44336FF;
            color: white;
        }

        table {
            border-collapse: collapse;
            width: 75%;
            float: left;
            background-color: white;
            color: black;
        }

        table, th, td {
            border: 1px solid black;
        }

        th, td {
            padding: 10px;
            text-align: left;
        }

        .flag-button {
            background-color: #4CAF50;
            color: white;
            border: none;
            padding: 5px 10px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 12px;
            cursor: pointer;
        }

        #map-button {
            float: right;
            padding: 10px;
            background-color: #2196F3;
            color: white;
            border: none;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            cursor: pointer;
        }
    </style>
    <meta http-equiv="refresh" content="20"> <!-- Add this line for refreshing every 30 seconds -->
    <script>
        function playAlarm() {
            // Create an audio element
            var audio = new Audio('http://secapp.qooarx.com/alarm.mp3');

            // Play the audio after a user interaction (e.g., click)
            document.addEventListener('click', function () {
                audio.play();
                }, { once: true });
            }

        // Function to check for the word "Unflagged" and play the alarm
        function checkAndPlayAlarm() {
            var statusCells = document.querySelectorAll('td:nth-child(8)'); // Assuming Status is the 8th column

            statusCells.forEach(function (cell) {
                if (cell.textContent.trim() === 'Unflagged') {
                    playAlarm();
                    return; // Stop checking once an "Unflagged" status is found
                    }
                });
            }

        // Trigger the checkAndPlayAlarm function when the page is loaded
        window.onload = function () {
            checkAndPlayAlarm();
            };
    </script>
</head>
<body>

<button id="map-button" onclick="openMap()">Open Map</button>
<center><h1>Security Response Unit Admin Panel</h1></center>
<table>
    <tr>
        <th>Case No.</th>
        <th>Latitude</th>
        <th>Longitude</th>
        <th>Name</th>
        <th>Age</th>
        <th>Gender</th>
        <th>Mobile Number</th>
        <th>Status</th>
        <th>Time Flagged</th>
        <th>Details</th>
        <th>Action</th>
    </tr>

    <?php
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row['DateTime'] . "</td>";
            echo "<td>" . $row['Latitude'] . "</td>";
            echo "<td>" . $row['Longitude'] . "</td>";
            echo "<td>" . $row['Name'] . "</td>";
            echo "<td>" . $row['Age'] . "</td>";
            echo "<td>" . $row['Gender'] . "</td>";
            echo "<td>" . $row['MobileNumber'] . "</td>";
            echo "<td>" . $row['Status'] . "</td>";
            echo "<td>" . $row['TimeFlagged'] . "</td>";
            echo "<td>" . $row['Details'] . "</td>";
            echo "<td><button class='flag-button' onclick='flagIncident(\"" . $row['DateTime'] . "\")'>Flag</button></td>";
            echo "</tr>";
        }
    } else {
        echo "<tr><td colspan='8'>No incidents found</td></tr>";
    }
    ?>
</table>
<br><br><br>
<center><a href="http://secapp.qooarx.com/reserve.php">Create a PIN for New User(s)</a>     |     <a href="http://secapp.qooarx.com/deactivate.php">Deactivate Users</a></center>

<script>
    function flagIncident(dateTime) {
        // AJAX request to update the incident status
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function () {
            if (this.readyState === 4 && this.status === 200) {
                alert("Incident flagged successfully!");
                location.reload(); // Refresh the page after flagging
            }
        };
        xhttp.open("GET", "flag_incident.php?dateTime=" + dateTime, true);
        xhttp.send();
    }

    function openMap() {
        // AJAX request to get the last row from the Incidence table
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function () {
            if (this.readyState === 4 && this.status === 200) {
                var data = JSON.parse(this.responseText);

                // Check if data is available
                if (data.length > 0) {
                    // Get the last row
                    var lastRow = data[data.length - 1];

                    // Extract Latitude and Longitude
                    var latitude = lastRow.Latitude;
                    var longitude = lastRow.Longitude;

                    // Open the map with the retrieved values
                    window.open("https://www.openstreetmap.org/?mlat=" + latitude + "&mlon=" + longitude + "&zoom=20", "_blank");
                } else {
                    alert("No incidents found to open on the map.");
                }
            }
        };
        xhttp.open("GET", "get_last_row.php", true);
        xhttp.send();
    }
</script>

</body>
</html>

<?php
// Close database connection
$conn->close();
?>
