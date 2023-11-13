<script>
    $(function() {
        // Sales graph chart
        var salesGraphChartCanvas = $('#line-chart').get(0).getContext('2d');
        //$('#revenue-chart').get(0).getContext('2d');

        var salesGraphChartData = {
            labels: ['2011 Q1', '2011 Q2', '2011 Q3', '2011 Q4', '2012 Q1', '2012 Q2', '2012 Q3', '2012 Q4',
                '2013 Q1', '2013 Q2'
            ],
            datasets: [{
                label: 'Digital Goods',
                fill: false,
                borderWidth: 2,
                lineTension: 0,
                spanGaps: true,
                borderColor: '#efefef',
                pointRadius: 3,
                pointHoverRadius: 7,
                pointColor: '#efefef',
                pointBackgroundColor: '#efefef',
                data: [2666, 2778, 4912, 3767, 6810, 5670, 4820, 15073, 10687, 8432]
            }]
        }

        var salesGraphChartOptions = {
            maintainAspectRatio: false,
            responsive: true,
            legend: {
                display: false,
            },
            scales: {
                xAxes: [{
                    ticks: {
                        fontColor: '#efefef',
                    },
                    gridLines: {
                        display: false,
                        color: '#efefef',
                        drawBorder: false,
                    }
                }],
                yAxes: [{
                    ticks: {
                        stepSize: 5000,
                        fontColor: '#efefef',
                    },
                    gridLines: {
                        display: true,
                        color: '#efefef',
                        drawBorder: false,
                    }
                }]
            }
        }

        // This will get the first returned node in the jQuery collection.
        var salesGraphChart = new Chart(salesGraphChartCanvas, {
            type: 'line',
            data: salesGraphChartData,
            options: salesGraphChartOptions
        })

    });
</script>
