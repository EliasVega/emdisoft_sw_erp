@extends('layouts.admin')
@section('titulo')
    {{ config('app.name', 'EmdisoftPro') }}
@endsection
@section('content')
    <main class="main">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <h5>Listado de Ventas</h5>
                @if (indicator()->restaurant == 'off')

                        <a href="createPos" class="btn btn-blueGrad btn-sm m-2"><i class="fa fa-plus mr-2"></i> Ventas pos</a>
                        <a href="invoice/create" class="btn btn-greenGrad btn-sm m-2"><i class="fa fa-plus mr-2"></i> Ventas</a>

                        <a href="invoiceOrder" class="btn btn-orangeGrad btn-sm m-2"><i class="fa fa-plus mr-2"></i>
                            Orden/Venta</a>

                    <a href="remission" class="btn btn-lemonGrad btn-sm m-2"><i class="fa fa-plus mr-2"></i> Remisiones</a>
                @else
                        <a href="restaurantOrder/create" class="btn btn-greenGrad btn-sm m-2"><i class="fa fa-plus mr-2"></i>
                            Comandas</a>
                            <a href="createPos" class="btn btn-blueGrad btn-sm m-2"><i class="fa fa-plus mr-2"></i> Ventas pos</a>
                        <a href="invoice/create" class="btn btn-greenGrad btn-sm m-2"><i class="fa fa-plus mr-2"></i> Ventas</a>
                        <a href="remission" class="btn btn-lemonGrad btn-sm m-2"><i class="fa fa-plus mr-2"></i> Remisiones</a>
                @endif

                @can('branch.index')
                    <a href="{{ route('branch.index') }}" class="btn btn-blueGrad btn-sm"><i
                            class="fas fa-undo-alt mr-2"></i>Inicio</a>
                @endcan
                @can('customer.index')
                    <a href="{{ route('customer.index') }}" class="btn btn-blueGrad btn-sm m-2"><i
                            class="fas fa-undo-alt mr-2"></i>Clientes</a>
                @endcan
                @can('ncinvoice.index')
                    <a href="{{ route('ncinvoice.index') }}" class="btn btn-blueGrad btn-sm m-2"><i
                            class="fas fa-undo-alt mr-2"></i>N.C.</a>
                @endcan
                @can('ndinvoice.index')
                    <a href="{{ route('ndinvoice.index') }}" class="btn btn-blueGrad btn-sm m-2"><i
                            class="fas fa-undo-alt mr-2"></i>N.D.</a>
                @endcan
                @can('pay.index')
                    <a href="{{ route('pay.index') }}" class="btn btn-blueGrad btn-sm m-2"><i
                            class="fas fa-undo-alt mr-2"></i>Abonos</a>
                @endcan
                @can('branchProduct.index')
                    <a href="{{ route('branchProduct.index') }}" class="btn btn-blueGrad btn-sm m-2"><i
                            class="fas fa-undo-alt mr-2"></i>Productos Sucursal</a>
                @endcan
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-condensed table-hover" id="invoices">
                        <thead>
                            <tr class="trdatacolor">
                                <th></th>
                                <th hidden="true">Id</th>
                                <th>Cliente</th>
                                <th>#Fac_Venta</th>
                                <th>Valor</th>
                                <th>Abonos</th>
                                <th>Retenciones</th>
                                <th>Saldo</th>
                                <th>Total + NC - ND</th>
                                <th>Fecha</th>
                                <th>Estado</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
        @push('scripts')
            <script type="text/javascript">
                $(document).ready(function() {
                    var typeDocument = "{{ $typeDocument ?? '' }}";
                    var dian = "{{ $dian ?? '' }}";
                    function print() {
                        if (typeDocument == 'invoice') {
                            var invoice = "{{ $invoice ?? '' }}";
                            if (invoice != '') {
                                var imprimir = "{{ route('pdfInvoice', ['invoice' => ':invoice']) }}";
                                imprimir = imprimir.replace(':invoice', invoice);
                                window.open(imprimir, "_blank");
                            }
                        } else if (typeDocument == 'pos') {
                            var invoice = "{{ $invoice ?? '' }}";
                            if (invoice != '') {
                                var imprimir = "{{ route('posPdf', ['invoice' => ':invoice']) }}";
                                imprimir = imprimir.replace(':invoice', invoice);
                                window.open(imprimir, "_blank");
                            }
                        } else {

                        }
                    }
                    print();

                    function format(d) {
                        return `
                        <table cellpadding="3" cellspacing="0" border="0" style="padding-left:50px;">
                            <tr>
                                <td>Observaciones</td>
                                <td>${d.observation}</td>
                            </tr>
                        </table>
                        `;
                    }
                    var invoices = $('#invoices').DataTable({
                        info: true,
                        paging: true,
                        ordering: true,
                        searching: true,
                        responsive: true,
                        autoWidth: true,
                        processing: true,
                        serverSide: true,
                        language: {
                            url: "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json"
                        },
                        ajax: '{{ route('invoice.index') }}',
                        order: [
                            [1, "desc"]
                        ],
                        columns: [{
                                className: 'details-control',
                                orderable: false,
                                data: null,
                                defaultContent: ''
                            },
                            {
                                data: 'id',
                                visible: false,
                                searchable: false
                            },
                            {
                                data: 'customer'
                            },
                            {
                                data: 'document'
                            },
                            {
                                data: 'total_pay',
                                className: 'dt-body-right',
                                render: $.fn.dataTable.render.number('.', ',', 2, '$')
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
                                data: 'created_at'
                            },
                            {
                                data: 'status'
                            },
                            {
                                data: 'btn'
                            },
                        ],
                        columnDefs: [{
                                targets: 0
                            },
                            {
                                targets: 1
                            },
                            {
                                targets: 2
                            },
                            {
                                targets: 3
                            },
                            {
                                targets: 4
                            },
                            {
                                targets: 5
                            },
                            {
                                targets: 6
                            },
                            {
                                targets: 7
                            },
                            {
                                targets: 8
                            },
                            {
                                targets: 9
                            },
                            {
                                targets: 10
                            },
                            {
                                targets: 11
                            },
                        ],
                        dom: 'Blfrtip',
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
                    });
                    $('#invoices tbody').on('click', 'td.details-control', function() {
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
                });
            </script>
        @endpush
    </main>
@endsection
