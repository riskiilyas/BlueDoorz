<canvas id="trChart" width="400" height="400" style="max-height:400px;"></canvas>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx2 = document.getElementById('trChart');
    // Fetch reservation data from Laravel backend
    fetch('/transactions')
        .then(response => response.json())
        .then(data => {
            new Chart(ctx2, {
                type: 'line',
                data: {
                    labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
                    datasets: [{
                        backgroundColor: 'rgba(39, 103, 245, 0.8)',
                        label: 'Monthly Transactions',
                        data: data,
                        borderColor: 'rgba(39, 103, 245, 0.8)',
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
