<?php

include("opendb.php"); // Åbner forbindelse til databasen

// SQL-forespørgsel for at hente sensor data fra databasen, sorteret efter timestamp
$sqlQuery = "SELECT sensor, location, value, timestamp FROM sensordata ORDER BY timestamp";
$result = mysqli_query($conn, $sqlQuery); // Eksekverer SQL-forespørgslen

$dataArray = []; // Opretter et tomt array til at gemme dataene

// Henter rækkerne fra resultatet og gemmer dem i dataArray
while ($row = mysqli_fetch_assoc($result)) {
    $dataArray[] = $row; // Gemmer hver række som et array i dataArray
}

?>

<!DOCTYPE html>
<html lang="da">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sensor Data</title>
</head>
<body>
    <h1>Sensor Data</h1>
    
    <?php
    // Loop gennem dataArray og vis dataene som tekst
    foreach ($dataArray as $entry) {
        echo "Sensor: " . htmlspecialchars($entry['sensor']) . " ";
        echo "Location: " . htmlspecialchars($entry['location']) . " ";
        echo "Value: " . htmlspecialchars($entry['value']) . " ";
        echo "Timestamp: " . htmlspecialchars($entry['timestamp']) . "<br>";
    }
    ?>
</body>
</html>
