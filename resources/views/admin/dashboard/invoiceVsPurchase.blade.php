<script type="text/javascript">
    google.charts.load('current', {
        'packages': ['bar']
    });
    google.charts.setOnLoadCallback(drawChart);

    function drawChart() {
        var data = google.visualization.arrayToDataTable([
            ['Total de compras y ventas', 'Compras', 'Ventas'],
            ['Compras - Ventas', {{ $purchaseTotal }}, {{ $invoiceTotal }}]
        ]);

        var options = {
            chart: {
                title: 'Compras vs Ventas',
            }
        };

        var chart = new google.charts.Bar(document.getElementById('purchases_vs_invoices'));
        chart.draw(data, google.charts.Bar.convertOptions(options));
    }
</script>
