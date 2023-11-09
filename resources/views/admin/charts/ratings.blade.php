<canvas id="rtChart" width="400" height="400" style="max-height:400px;"></canvas>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx4 = document.getElementById('rtChart');
    // Fetch reservation data from Laravel backend
    fetch('/avg_ratings')
        .then(response => response.json())
        .then(data => {
            new Chart(ctx4, {
                type: 'line',
                data: {
                    labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
                    datasets: [{
                        backgroundColor: 'rgba(39, 103, 245, 0.8)',
                        label: 'Monthly Average Ratings',
                        data: data,
                        borderColor: 'rgba(177, 233, 55, 0.8)',
                        fill: false,
                        cubicInterpolationMode: 'monotone',
                        tension: 0.4
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        });

</script>
