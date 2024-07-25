@extends('layouts.admin')
@section('titulo')
    {{ config('app.name', 'EmdisoftPro') }}
@endsection
@section('content')
    <main class="main">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="card-header">

                        <div class="row input-daterange input-group" id="datepicker">
                            <div class="col-12 col-md-2">
                                <input type="date" name="start_date" id="start_date" class="form-control"
                                    max="{{ date('Y-m-d') }}">
                            </div>
                            <div class="col-12 col-md-2">
                                <input type="date" name="end_date" id="end_date" class="form-control"
                                    max="{{ date('Y-m-d') }}">
                            </div>
                            <div class="col-12 col-md-2">
                                <a id="search_button" class="btn btn-primary btn-block">Buscar <i
                                        class="fa-solid fa-magnifying-glass ml-md-1"></i></a>
                            </div>
                            <div class="col-12 col-md-2">
                                <a id="show_all_button" class="btn btn-secondary btn-block">Todos los registros <i
                                        class="fa-solid fa-list ml-md-1"></i></a>
                            </div>
                        </div>
                    </div>
                    <br>
                </div>
            </div>
        </div>
        <div class="text-center py-3">
            <a class="toggle-vis btn btn-sm btn-info" data-column="0">Id</a>
            <a class="toggle-vis btn btn-sm btn-info" data-column="1">Documento</a>
            <a class="toggle-vis btn btn-sm btn-info" data-column="2">F/gen</a>
            <a class="toggle-vis btn btn-sm btn-info" data-column="3">F/ven</a>
            <a class="toggle-vis btn btn-sm btn-info" data-column="4">Tercero</a>
            <a class="toggle-vis btn btn-sm btn-info" data-column="5">CC-NIT</a>
            <a class="toggle-vis btn btn-sm btn-info" data-column="6">Abonos</a>
            <a class="toggle-vis btn btn-sm btn-info" data-column="7">Retencion</a>
            <a class="toggle-vis btn btn-sm btn-info" data-column="8">Saldo</a>
            <a class="toggle-vis btn btn-sm btn-info" data-column="9">Valor/fecha</a>
            <a class="toggle-vis btn btn-sm btn-info" data-column="10">Total</a>
            <a class="toggle-vis btn btn-sm btn-info" data-column="11">Impuesto</a>
            <a class="toggle-vis btn btn-sm btn-info" data-column="12">V/Total</a>
        </div>
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-condensed table-hover" id="invoices">
                        <thead class="trdatacolor">
                            <tr>
                                <th>Id</th>
                                <th>Documento</th>
                                <th>F/gener</th>
                                <th>F/venc</th>
                                <th>Tercero</th>
                                <th>CC-NIT</th>
                                <th>Abonos</th>
                                <th>Retenciones</th>
                                <th>Saldo</th>
                                <th>NC + ND</th>
                                <th>Total</th>
                                <th>Impuesto</th>
                                <th>V/Total</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th colspan="13" style="text-align:right">Totales:</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
        @push('scripts')
            <script type="text/javascript">
                $(document).ready(function() {
                    var invoices = $('#invoices').DataTable({
                        info: true,
                        paging: true,
                        ordering: true,
                        searching: true,
                        responsive: true,
                        autoWidth: true,
                        processing: true,
                        serverSide: true,
                        stateSave: true,
                        language: {
                            url: "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json"
                        },
                        ajax: '{{ route('reportInvoice') }}',
                        order: [
                            [0, "desc"]
                        ],
                        columns: [{
                                data: 'id'
                            },
                            {
                                data: 'document'
                            },
                            {
                                data: 'generation_date'
                            },
                            {
                                data: 'due_date'
                            },
                            {
                                data: 'customer'
                            },
                            {
                                data: 'identification'
                            },
                            {
                                data: 'pay',
                                className: 'dt-body-right',
                                render: $.fn.dataTable.render.number('.', ',', 2, '$')
                            },
                            {
                                data: 'retention',
                                className: 'dt-body-right',
                                render: $.fn.dataTable.render.number('.', ',', 2, '$')
                            },
                            {
                                data: 'balance',
                                className: 'dt-body-right',
                                render: $.fn.dataTable.render.number('.', ',', 2, '$')
                            },
                            {
                                data: 'grand_total',
                                className: 'dt-body-right',
                                render: $.fn.dataTable.render.number('.', ',', 2, '$')
                            },
                            {
                                data: 'total',
                                className: 'dt-body-right',
                                render: $.fn.dataTable.render.number('.', ',', 2, '$')
                            },
                            {
                                data: 'total_tax',
                                className: 'dt-body-right',
                                render: $.fn.dataTable.render.number('.', ',', 2, '$')
                            },
                            {
                                data: 'total_pay',
                                className: 'dt-body-right',
                                render: $.fn.dataTable.render.number('.', ',', 2, '$')
                            },
                        ],
                        dom: 'Bfltip',
                        lengthMenu: [
                            [10, 20, 50, 100, 500, -1],
                            [10, 20, 50, 100, 500, 'Todos']
                        ],
                        buttons: [{
                                extend: 'copy',
                                exportOptions: {
                                    columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12]
                                }
                            },
                            {
                                extend: 'excel',
                                exportOptions: {
                                    columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12]
                                }
                            },
                            {
                                extend: 'pdf',
                                extend: 'pdfHtml5',
                                orientation: 'landscape',
                                pageSize: 'LEGAL',
                                exportOptions: {
                                    columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12]
                                }
                            },
                            {
                                extend: 'print',
                                exportOptions: {
                                    columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12]
                                }
                            },
                        ],
                        drawCallback: function(settings) {
                            var api = this.api();
                            var rows = api.rows({
                                page: 'current'
                            }).nodes();
                            var last = null;
                            api.column(4, {
                                page: 'current'
                            }).data().each(function(group, i) {
                                if (last !== group) {
                                    $(rows).eq(i).before(
                                        `<tr class="bg-secondary"><td colspan="100">${group}</td></tr>`
                                    );
                                    last = group;
                                }
                            });
                        },
                        footerCallback: function(row, data, start, end, display) {
                            var api = this.api(),
                                data;

                            var intVal = function(i) {
                                return typeof i === 'string' ?
                                    i.replace(/[\$]/g, '').replace(/,/g, '.') * 1 :
                                    typeof i === 'number' ?
                                    i : 0;
                            };

                            var total = api
                            .column(10)
                            .data()
                            .reduce(function(a, b) {
                                return intVal(a) + intVal(b);
                            }, 0);
                            var totaltax = api
                            .column(11)
                            .data()
                            .reduce(function(a, b) {
                                return intVal(a) + intVal(b);
                            }, 0);
                            var valuetotal = api
                            .column(12)
                            .data()
                            .reduce(function(a, b) {
                                return intVal(a) + intVal(b);
                            }, 0);
                            var formatNumberData = $.fn.dataTable.render.number(',', '.', 0, '').display;
                            $(api.column(11).footer()).html(
                                `(total = $ ${formatNumberData(total)}) (imp = $ ${formatNumberData( totaltax )}) (v/toal = $ ${formatNumberData( valuetotal )})`
                            )
                        }
                    });
                    $("a.toggle-vis").on("click", function(e) {
                        e.preventDefault();
                        var column = invoices.column($(this).data("column"));
                        column.visible(!column.visible());
                    });
                    $('#search_button').click(function() {
                        var startDate = $('#start_date').val();
                        var endDate = $('#end_date').val();

                        if (endDate < startDate) {
                            alert('La fecha de fin debe ser mayor que la fecha de inicio');
                            return;
                        }

                        if (startDate != null && endDate != null) {
                            invoices.ajax.url("{{ route('reportInvoice') }}" + "?start_date=" +
                                startDate + "&end_date=" + endDate).load();
                        }
                    });

                    $(document).on('click', '#show_all_button', function() {
                        $('#start_date').val('');
                        $('#end_date').val('');

                        invoices.ajax.url("{{ route('reportInvoice') }}").load();
                    });
                });
            </script>
        @endpush
    </main>
@endsection
