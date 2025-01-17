<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Income Types Chart</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
    <div style="width: 80%; margin: 0 auto;">
        <h1>Income Types Chart</h1>
        <canvas id="incomeChart"></canvas>
    </div>

    <script>
        // Pass PHP data to JavaScript
        const incomeData = @json($incomeData);

        // Extract labels and values
        const labels = incomeData.map(data => data.type);
        const values = incomeData.map(data => data.total_amount);

        // Create the chart
        const ctx = document.getElementById('incomeChart').getContext('2d');
        new Chart(ctx, {
            type: 'bar', // Choose chart type (e.g., 'pie', 'bar', 'line')
            data: {
                labels: labels,
                datasets: [{
                    label: 'Income Amount by Type',
                    data: values,
                    backgroundColor: 'rgba(54, 162, 235, 0.5)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: { display: true },
                    tooltip: { enabled: true }
                },
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
    
</body>
</html>
