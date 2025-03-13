<?php

include("opendb.php"); // Så har vi åbnet db for at komme i gang

// Vi skal indlæse data i et array
$sqlQuery = "SELECT sensor, location, value, timestamp FROM sensordata ORDER BY timestamp";
$result = mysqli_query($conn, $sqlQuery);

$dataArray = [];
while ($row = mysqli_fetch_assoc($result)) {
    $dataArray[] = $row;
}

// Arrays til Chart.js
$timestamps = [];
$values = [];

foreach ($dataArray as $entry) {
    $timestamps[] = $entry['timestamp'];
    $values[] = (int) $entry['value']; // Sikrer, at værdien er et heltal
}

// Konverterer arrays til JSON-format til Chart.js
$chartData = [
    'labels' => $timestamps,
    'datasets' => [
        [
            'label' => 'Sensor Data',
            'data' => $values,
            'borderColor' => 'rgba(75, 192, 192, 1)',
            'backgroundColor' => 'rgba(75, 192, 192, 0.2)',
            'fill' => false
        ]
    ]
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
    <canvas id="sensorChart"></canvas>
    <script>
        const chartData = <?php echo json_encode($chartData); ?>;
        const ctx = document.getElementById('sensorChart').getContext('2d');
        new Chart(ctx, {
            type: 'line',
            data: chartData,
            options: {
                responsive: true,
                scales: {
                    x: { title: { display: true, text: 'Timestamp' } },
                    y: { title: { display: true, text: 'Value' } }
                }
            }
        });
    </script>
</body>
</html>
