<script type="text/javascript">
    google.charts.load("current", {
        packages: ["corechart"]
    });
    google.charts.setOnLoadCallback(drawChart);

    function drawChart() {
        var data = google.visualization.arrayToDataTable([
            ['Métodos de pago', '# de ventas'],
            @foreach ($invoicesByPaymentForm as $invoiceByPaymentForm)
                [
                    '{{ $invoiceByPaymentForm->first()->paymentForm->name }}',
                    {{ $invoiceByPaymentForm->count() }}
                ],
            @endforeach
        ]);

        var options = {
            title: '% de ventas a crédito y contado',
            pieHole: 0.4,
        };

        var chart = new google.visualization.PieChart(document.getElementById('invoices_by_payment_form'));
        chart.draw(data, options);
    }
</script>
