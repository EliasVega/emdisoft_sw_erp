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
                                <a id="show_all_button" class="btn btn-secondary btn-block">Refrescar <i
                                    class="fas fa-undo-alt mr-2"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <h5>Reportes
                        <a href="indexCanceled" class="btn btn-blueGrad btn-sm"><i class="fa fa-plus"></i> Cancelados</a>
                        <a href="{{ route('indexPendient') }}" class="btn btn-blueGrad btn-sm"><i class="fas fa-undo-alt mr-2"></i>Pendientes</a>
                        <a href="employee" class="btn btn-blueGrad btn-sm"><i class="fa fa-plus"></i> Operarios</a>
                </h5>
            </div>
        </div>
        <div class="text-center py-3">
            <a class="toggle-vis btn btn-sm btn-info" data-column="0">Tercero</a>
            <a class="toggle-vis btn btn-sm btn-info" data-column="1">Identificacion</a>
            <a class="toggle-vis btn btn-sm btn-info" data-column="2">Fecha</a>
            <a class="toggle-vis btn btn-sm btn-info" data-column="3">Factura</a>
            <a class="toggle-vis btn btn-sm btn-info" data-column="4">Estado</a>
            <a class="toggle-vis btn btn-sm btn-info" data-column="5">Nombre Item</a>
            <a class="toggle-vis btn btn-sm btn-info" data-column="6">Tipo</a>
            <a class="toggle-vis btn btn-sm btn-info" data-column="7">Cantidad</a>
            <a class="toggle-vis btn btn-sm btn-info" data-column="8">Valor</a>
            <a class="toggle-vis btn btn-sm btn-info" data-column="9">Subtotal</a>
            <a class="toggle-vis btn btn-sm btn-info" data-column="10">%</a>
            <a class="toggle-vis btn btn-sm btn-info" data-column="11">Comision</a>
        </div>
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-condensed table-hover" id="employeeInvoices">
                        <thead class="trdatacolor">
                            <tr>
                                <th>Tercero</th>
                                <th>CC-NIT</th>
                                <th>Fecha</th>
                                <th>Factura</th>
                                <th>Estado</th>
                                <th>Nombre Item</th>
                                <th>Tipo</th>
                                <th>Cant.</th>
                                <th>Valor</th>
                                <th>Subtotal</th>
                                <th>%</th>
                                <th>V/Comision</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th colspan="12" style="text-align:right">Totales:</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
        @push('scripts')
            <script type="text/javascript">
                $(document).ready(function() {
                    var invoices = $('#employeeInvoices').DataTable({
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
                        ajax: '{{ route('indexCanceled') }}',
                        order: [
                            [0, "asc"]
                        ],
                        columns: [{
                                data: 'employee'
                            },
                            {
                                data: 'identification'
                            },
                            {
                                data: 'created_at'
                            },
                            {
                                data: 'document'
                            },
                            {
                                data: 'status',
                            },
                            {
                                data: 'product'
                            },
                            {
                                data: 'type'
                            },
                            {
                                data: 'quantity',
                            },
                            {
                                data: 'price',
                                className: 'dt-body-right',
                                render: $.fn.dataTable.render.number('.', ',', 2, '$')
                            },
                            {
                                data: 'subtotal',
                                className: 'dt-body-right',
                                render: $.fn.dataTable.render.number('.', ',', 2, '$')
                            },
                            {
                                data: 'percentage',
                            },
                            {
                                data: 'value_commission',
                                className: 'dt-body-right',
                                render: $.fn.dataTable.render.number('.', ',', 2, '$')
                            },
                        ],
                        columnDefs: [
                            {targets: 0, visible: false},
                            {targets: 1},
                            {targets: 2},
                            {targets: 3},
                            {targets: 4},
                            {targets: 5},
                            {targets: 6},
                            {targets: 7},
                            {targets: 8},
                            {targets: 9},
                            {targets: 10},
                            {targets: 11},
                        ],
                        dom: 'Bfltip',
                        lengthMenu: [
                            [10, 20, 50, 100, 500, -1],
                            [10, 20, 50, 100, 500, 'Todos']
                        ],
                        buttons: [{
                                extend: 'copy',
                                exportOptions: {
                                    columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11]
                                }
                            },
                            {
                                extend: 'excel',
                                exportOptions: {
                                    columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11]
                                }
                            },
                            {
                                extend: 'pdf',
                                extend: 'pdfHtml5',
                                orientation: 'landscape',
                                pageSize: 'LEGAL',
                                exportOptions: {
                                    columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11]
                                }
                            },
                            {
                                extend: 'print',
                                exportOptions: {
                                    columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11]
                                }
                            },
                        ],
                        drawCallback: function (settings) {
                            var api = this.api();
                            var rows = api.rows({page: 'current'}).nodes();
                            var last = null;
                            api.column(0, {page: 'current'}).data().each(function (group, i) {
                                if (last !== group) {
                                    $(rows).eq(i).before(
                                        `<tr class="highlight"><td colspan="11">${group}</td></tr>`
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

                            var totalPage = api
                                .column(11, {
                                    page: 'current'
                                })
                                .data()
                                .reduce(function(a, b) {
                                    return intVal(a) + intVal(b);
                                }, 0);
                            var formatNumberData = $.fn.dataTable.render.number(',', '.', 0, '').display;
                            $(api.column(11).footer()).html(
                                `$ ${formatNumberData(totalPage)} ($ ${formatNumberData( total )})`
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
                            invoices.ajax.url("{{ route('employeeInvoiceProduct.index') }}" + "?start_date=" +
                                startDate + "&end_date=" + endDate).load();
                        }
                    });

                    $(document).on('click', '#show_all_button', function() {
                        $('#start_date').val('');
                        $('#end_date').val('');

                        invoices.ajax.url("{{ route('employeeInvoiceProduct.index') }}").load();
                    });
                });
            </script>
        @endpush
    </main>
@endsection
