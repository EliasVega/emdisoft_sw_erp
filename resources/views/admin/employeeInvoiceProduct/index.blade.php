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
            <a class="toggle-vis btn btn-sm btn-info" data-column="1">Id</a>
            <a class="toggle-vis btn btn-sm btn-info" data-column="2">Tercero</a>
            <a class="toggle-vis btn btn-sm btn-info" data-column="3">Identificacion</a>
            <a class="toggle-vis btn btn-sm btn-info" data-column="4">Fecha</a>
            <a class="toggle-vis btn btn-sm btn-info" data-column="5">Cliente</a>
            <a class="toggle-vis btn btn-sm btn-info" data-column="6">Factura</a>
            <a class="toggle-vis btn btn-sm btn-info" data-column="7">Estado</a>
            <a class="toggle-vis btn btn-sm btn-info" data-column="8">Nombre Item</a>
            <a class="toggle-vis btn btn-sm btn-info" data-column="9">Subtotal</a>
            <a class="toggle-vis btn btn-sm btn-info" data-column="10">%</a>
            <a class="toggle-vis btn btn-sm btn-info" data-column="11">Comision</a>
            <a class="toggle-vis btn btn-sm btn-info" data-column="12">Editar</a>
        </div>
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-condensed table-hover" id="employeeInvoiceProducts">
                        <thead class="trdatacolor">
                            <tr>
                                <th></th>
                                <th>id</th>
                                <th>Tercero</th>
                                <th>CC-NIT</th>
                                <th>Fecha</th>
                                <th>Cliente</th>
                                <th>Factura</th>
                                <th>Estado</th>
                                <th>Nombre Item</th>
                                <th>Subtotal</th>
                                <th>%</th>
                                <th>V/Comision</th>
                                <th>editar</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th colspan="13" style="text-align:right">Total:</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
        @push('scripts')
            <script type="text/javascript">
            function format(d) {
                return `
                    <table cellpadding="0" cellspacing="0" border="0" style="padding-left:50px;">
                        <tr>
                            <td>Observaciones</td>
                            <td>${d.observations}</td>
                        </tr>
                    </table>
                `;
            }
                $(document).ready(function() {
                    var invoices = $('#employeeInvoiceProducts').DataTable({
                        info: true,
                        paging: true,
                        //ordering: true,
                        searching: true,
                        responsive: true,
                        autoWidth: true,
                        processing: true,
                        serverSide: true,
                        stateSave: true,
                        language: {
                            url: "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json"
                        },
                        ajax: '{{ route('employeeInvoiceProduct.index') }}',
                        order: [[1, "desc"]],
                        columns: [
                            {
                                className: 'details-control',
                                orderable: false,
                                data: null,
                                defaultContent: ''
                            },
                            {
                                data: 'id',
                            },
                            {
                                data: 'employee',
                            },
                            {
                                data: 'identification'
                            },
                            {
                                data: 'generation_date'
                            },
                            {
                                data: 'customer'
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
                            {
                                data: 'btn'
                            },
                        ],
                        columnDefs: [
                            {targets: 0},
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
                            {targets: 12},
                        ],
                        dom: 'Bfltip',
                        lengthMenu: [
                            [10, 20, 50, 100, 500],
                            [10, 20, 50, 100, 500]
                        ],
                        buttons: [{
                                extend: 'copy',
                                exportOptions: {
                                    columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11,12 ]
                                }
                            },
                            {
                                extend: 'excel',
                                exportOptions: {
                                    columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11,12 ]
                                }
                            },
                            {
                                extend: 'pdf',
                                extend: 'pdfHtml5',
                                orientation: 'landscape',
                                pageSize: 'LEGAL',
                                exportOptions: {
                                    columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11,12 ]
                                }
                            },
                            {
                                extend: 'print',
                                exportOptions: {
                                    columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11,12 ]
                                }
                            },
                        ],
                        //agrupa los datos por una columna
                        drawCallback: function (settings) {
                            var api = this.api();
                            var rows = api.rows({page: 'current'}).nodes();
                            var last = null;
                            api.column(2, {page: 'current'}).data().each(function (group, i) {
                                if (last !== group) {
                                    $(rows).eq(i).before(
                                        `<tr class="highlight"><td colspan="13">${group}</td></tr>`
                                    );
                                    last = group;
                                }
                            });
                        },

                       //coloca los totales a pie de pagina
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
                                .column(11)
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

                    //muestra los detalles
                    $('#employeeInvoiceProducts tbody').on('click', 'td.details-control', function () {
                        let tr = $(this).closest('tr');
                        let row = invoices.row(tr);

                        if (row.child.isShown()) {
                            row.child.hide();
                            tr.removeClass('shown');
                        } else {
                            row.child(format(row.data())).show();
                            tr.addClass('shown');
                        }
                    });
                    //esconde columnas
                    $("a.toggle-vis").on("click", function(e) {
                        e.preventDefault();
                        var column = invoices.column($(this).data("column"));
                        column.visible(!column.visible());
                    });
                    //Buscadores
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
                    //refrescar la pagina
                    $(document).on('click', '#show_all_button', function() {
                        $('#start_date').val('');
                        $('#end_date').val('');
                        location.reload();
                        //invoices.ajax.url("{{ route('employeeInvoiceProduct.index') }}").reload();

                    });
                });

            </script>
        @endpush
    </main>
@endsection
