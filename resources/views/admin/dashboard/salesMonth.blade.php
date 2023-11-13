<script>
    $(function() {
        /* Chart.js Charts */
        // Sales chart
        var salesChartCanvas = document.getElementById('revenue-chart-canvas').getContext('2d');
        //$('#revenue-chart').get(0).getContext('2d');

        var salesChartData = {
            labels: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Ocrubre', 'Noviembre', 'Diciembre'],
            datasets: [{
                    label: 'Digital Goods',
                    backgroundColor: 'rgba(60,141,188,0.9)',
                    borderColor: 'rgba(60,141,188,0.8)',
                    pointRadius: false,
                    pointColor: '#3b8bba',
                    pointStrokeColor: 'rgba(60,141,188,1)',
                    pointHighlightFill: '#fff',
                    pointHighlightStroke: 'rgba(60,141,188,1)',
                    data: [28, 48, 40, 19, 86, 27, 90, 31, 23, 55, 48, 43]
                },
                {
                    label: 'Electronics',
                    backgroundColor: 'rgba(210, 214, 222, 1)',
                    borderColor: 'rgba(210, 214, 222, 1)',
                    pointRadius: false,
                    pointColor: 'rgba(210, 214, 222, 1)',
                    pointStrokeColor: '#c1c7d1',
                    pointHighlightFill: '#fff',
                    pointHighlightStroke: 'rgba(220,220,220,1)',
                    data: [65, 59, 80, 81, 56, 55, 40, 35, 92, 27, 55, 69]
                },
            ]
        }

        var salesChartOptions = {
            maintainAspectRatio: false,
            responsive: true,
            legend: {
                display: false
            },
            scales: {
                xAxes: [{
                    gridLines: {
                        display: false,
                    }
                }],
                yAxes: [{
                    gridLines: {
                        display: false,
                    }
                }]
            }
        }

        // This will get the first returned node in the jQuery collection.
        var salesChart = new Chart(salesChartCanvas, {
            type: 'line',
            data: salesChartData,
            options: salesChartOptions
        })


        // Donut Chart
        var pieChartCanvas = $('#sales-chart-canvas').get(0).getContext('2d')
        var pieData = {
            labels: [
                'Instore Sales',
                'Download Sales',
                'Mail-Order Sales',
            ],
            datasets: [{
                data: [30, 12, 20],
                backgroundColor: ['#f56954', '#00a65a', '#f39c12'],
            }]
        }
        var pieOptions = {
            legend: {
                display: false
            },
            maintainAspectRatio: false,
            responsive: true,
        }
        //Create pie or douhnut chart
        // You can switch between pie and douhnut using the method below.
        var pieChart = new Chart(pieChartCanvas, {
            type: 'doughnut',
            data: pieData,
            options: pieOptions
        });
    });
</script>
