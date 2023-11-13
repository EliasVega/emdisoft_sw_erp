<script type='text/javascript'>
    google.charts.load('current', {
        'packages': ['geochart'],
        'mapsApiKey': 'AIzaSyD-9tSrke72PouQMnMX-a7eZSW0jkFMBWY'
    });
    google.charts.setOnLoadCallback(drawMarkersMap);

    function drawMarkersMap() {
        var data = google.visualization.arrayToDataTable([
            ['Municipio', 'Total de ventas', 'Número de ventas'],
            @foreach ($invoicesByDepartment as $invoiceByDepartment)
                [
                    '{{ $invoiceByDepartment->first()->third->municipality->department->name }}',
                    {{ $invoiceByDepartment->sum('total_pay') }},
                    {{ $invoiceByDepartment->count() }}
                ],
            @endforeach
        ]);

        var options = {
            region: 'CO',
            colorAxis: {
                colors: ['green', 'blue']
            },
            datalessRegionColor: '#E5E5E5',
            resolution: 'provinces',
        };

        var chart = new google.visualization.GeoChart(document.getElementById('invoices_by_department'));
        chart.draw(data, options);
    }
</script>
