<!DOCTYPE html>
<html lang="da">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Simple Chart Example</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
    <h1>Simple Sensor Data Chart</h1>
    
    <!-- Canvas element til at vise grafen -->
    <canvas id="sensorChart"></canvas>

    <script>
        // Statisk data (7 målinger)
        const timestamps = [
            '12:00:00', '12:00:15', '12:00:30', 
            '12:00:45', '12:01:00', '12:01:15', 
            '12:01:30'
        ];

        const values = [914, 26, 286, 859, 918, 21, 542]; // Værdierne for målingerne

        // Data til grafen (Chart.js)
        const chartData = {
            labels: timestamps, // Tidsstempler som x-aksens labels
            datasets: [{
                label: 'Sensor Data', // Navn på datasættet
                data: values, // Værdierne på y-aksen
                borderColor: 'rgba(75, 192, 192, 1)', // Farve på linjen
                backgroundColor: 'rgba(75, 192, 192, 0.2)', // Baggrundsfarve
                fill: false // Linjen er ikke udfyldt
            }]
        };

        // Konfiguration for Chart.js
        const config = {
            type: 'line', // Linjegraf
            data: chartData,
            options: {
                responsive: true, // Gør grafen responsiv
                scales: {
                    x: {
                        title: {
                            display: true,
                            text: 'Tid (min:sek)' // Titel på x-aksen
                        }
                    },
                    y: {
                        title: {
                            display: true,
                            text: 'Værdi' // Titel på y-aksen
                        }
                    }
                }
            }
        };

        // Opretter grafen
        const ctx = document.getElementById('sensorChart').getContext('2d');
        new Chart(ctx, config); // Genererer grafen
    </script>
</body>
</html>
