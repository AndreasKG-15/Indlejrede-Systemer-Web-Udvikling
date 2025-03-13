<?php

include("opendb.php"); // Åbn databaseforbindelsen

// Indlæs data i et array
$sqlQuery = "SELECT sensor, value, timestamp FROM sensordata ORDER BY timestamp";
$result = mysqli_query($conn, $sqlQuery);

$dataArray = [];
while ($row = mysqli_fetch_assoc($result)) {
    $dataArray[] = $row;
}

// Arrays til Chart.js
$timestamps = [];
$sensorData = [];

// Indsæt alle timestamps og data organiseret pr. sensor
foreach ($dataArray as $entry) {
    $timestamps[] = $entry['timestamp'];
    $sensorData[$entry['sensor']][$entry['timestamp']] = (int) $entry['value'];
}

// Sørg for, at timestamps er unikke og sorteret
$timestamps = array_unique($timestamps);
sort($timestamps);

// Forbered datasets til Chart.js
$datasets = [];
$colors = [
    'rgb(75, 192, 192)',
    'rgba(255, 99, 132, 1)'
];
$bgColors = [
    'rgba(75, 192, 192, 0.2)',
    'rgba(255, 99, 132, 0.2)'
];
$index = 0;

// For hver sensor, saml data og udfyld med nuller, hvis der ikke er nogen værdi for en given timestamp
foreach ($sensorData as $sensor => $values) {
    $sensorValues = [];

    foreach ($timestamps as $timestamp) {
        // Hvis der er en værdi for den timestamp, brug den, ellers brug null
        if (isset($values[$timestamp])) {
            $sensorValues[] = $values[$timestamp];
        } else {
            $sensorValues[] = null; // Hvis der ikke er data, sæt null
        }
    }

    $datasets[] = [
        'label' => $sensor,
        'data' => $sensorValues,
        'borderColor' => $colors[$index % count($colors)],
        'backgroundColor' => $bgColors[$index % count($bgColors)],
        'fill' => false,
        'lineTension' => 0.1, // Juster linjetensionen for at gøre linjerne blødere
        'spanGaps' => true, // Tillad linjerne at springe over manglende data
        'yAxisID' => ($index == 0 ? 'y1' : 'y2') // Tildel hver sensor en forskellig y-akse
    ];
    $index++;
}

$chartData = [
    'labels' => $timestamps,
    'datasets' => $datasets
];
?>

<!DOCTYPE html>
<html lang="da">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sensor Data Chart</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
    <canvas id="sensorChart" width="800" height="400"></canvas>
    <script>
        // Kontroller data i JavaScript
        console.log("Chart Data: ", <?php echo json_encode($chartData); ?>);

        const chartData = <?php echo json_encode($chartData); ?>;

        // Tjek om chartData er korrekt
        if (!chartData || !chartData.datasets) {
            console.error("Fejl i chartData: ", chartData);
        }

        const ctx = document.getElementById('sensorChart').getContext('2d');
        
        try {
            new Chart(ctx, {
                type: 'line',
                data: chartData,
                options: {
                    responsive: true,
                    scales: {
                        x: {
                            title: { display: true, text: 'Timestamp' },
                            type: 'category', // Tidsstemplerne behandles som kategorier
                        },
                        y1: { // Første y-akse (for første sensor)
                            type: 'linear',
                            position: 'left',
                            title: { display: true, text: 'Sensor 1 Value' },
                            ticks: {
                                beginAtZero: true, // Start fra 0 for første sensor
                            }
                        },
                        y2: { // Anden y-akse (for den anden sensor)
                            type: 'linear',
                            position: 'right',
                            title: { display: true, text: 'Sensor 2 Value' },
                            ticks: {
                                beginAtZero: true, // Start fra 0 for den anden sensor
                            }
                        }
                    }
                }
            });
        } catch (error) {
            console.error("Fejl ved oprettelse af grafen: ", error);
        }
    </script>
</body>
</html>
