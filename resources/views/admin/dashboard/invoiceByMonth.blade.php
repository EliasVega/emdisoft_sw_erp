<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
        <script type="text/javascript">
            google.charts.load('current', {
                'packages': ['corechart']
            });
            google.charts.setOnLoadCallback(drawChart);

            function drawChart() {
                var data = google.visualization.arrayToDataTable([
                    ['Mes', 'Valor facturado', 'Indicador'],
                    @foreach ($invoicesByMonth as $invoiceMonth)
                        [
                            '{{ \Carbon\Carbon::parse($invoiceMonth->first()->created_at)->format('F') }}',
                            {{ $invoiceMonth->sum('total') }},
                            {{ $invoiceMonth->sum('total') }}
                        ],
                    @endforeach
                ]);

                var options = {
                    title: 'Ventas por mes',
                    seriesType: 'line',
                    series: {
                        0: {
                            type: 'bars'
                        }
                    }
                };

                var chart = new google.visualization.ComboChart(document.getElementById('invoices_by_month'));
                chart.draw(data, options);
            }
        </script>
