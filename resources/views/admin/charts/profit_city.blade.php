<canvas id="profitCityChart" width="400" height="400" style="max-height:400px;"></canvas>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx3 = document.getElementById('profitCityChart');

    fetch('/profit_city')
        .then(response => response.json())
        .then(data => {
            new Chart(ctx3, {
                type: 'pie',
                data: {
                    labels: data.map(cityData => cityData.city),
                    datasets: [{
                        label: '# City Total Income',
                        data: data.map(cityData => cityData.total_profit),
                        borderWidth: 1
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
