@extends('layouts.admin')
@section('titulo')
    {{ config('app.name', 'EmdisoftPro') }}
@endsection
@section('content')
    <main class="main">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <h5>Listado de Ordenes de venta</h5>
                    <a href="createPosOrder" class="btn btn-blueGrad btn-sm m-2"><i class="fa fa-plus mr-2"></i> Orden de Venta Pos</a>
                    <a href="invoiceOrder/create" class="btn btn-greenGrad btn-sm m-2"><i class="fa fa-plus mr-2"></i> Orden de Venta </a>
                    <a href="{{ route('invoice.index') }}" class="btn btn-blueGrad btn-sm"><i class="fas fa-undo-alt mr-2"></i>Ventas</a>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-condensed table-hover" id="invoiceOrders">
                        <thead>
                            <tr class="trdatacolor">
                                <th></th>
                                <th>Id</th>
                                <th>Cliente</th>
                                <th>Valor</th>
                                <th>Impuestos</th>
                                <th>Total</th>
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

                    function print() {
                        if (typeDocument == 'invoiceOrder') {
                            var invoiceOrder = "{{ $invoiceOrder ?? '' }}";
                            if (invoiceOrder != '') {
                                var imprimir = "{{ route('pdfInvoiceOrder', ['invoiceOrder' => ':invoiceOrder']) }}";
                                imprimir = imprimir.replace(':invoiceOrder', invoiceOrder);
                                window.open(imprimir, "_blank");
                            }
                        } else if (typeDocument == '') {

                        } else {
                            var invoiceOrder = "{{ $invoiceOrder ?? '' }}";
                            if (invoiceOrder != '') {
                                var imprimir = "{{ route('posInvoiceOrder', ['invoiceOrder' => ':invoiceOrder']) }}";
                                imprimir = imprimir.replace(':invoiceOrder', invoiceOrder);
                                window.open(imprimir, "_blank");
                            }
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
                    var invoiceOrders = $('#invoiceOrders').DataTable({
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
                        ajax: '{{ route('invoiceOrder.index') }}',
                        order: [
                            [1, "desc"]
                        ],
                        columns: [
                            {
                                className: 'details-control',
                                orderable: false,
                                data: null,
                                defaultContent: ''
                            },
                            {
                                data: 'id'
                            },
                            {
                                data: 'customer'
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
                        ],
                        dom: 'Blfrtip',
                        lengthMenu: [
                            [10, 20, 50, 100, 500, -1],
                            [10, 20, 50, 100, 500, 'Todos']
                        ],
                        buttons: [{
                                extend: 'copy',
                                exportOptions: {
                                    columns: [0, 1, 2, 3, 4, 5, 6, 7, 8]
                                }
                            },
                            {
                                extend: 'excel',
                                exportOptions: {
                                    columns: [0, 1, 2, 3, 4, 5, 6, 7, 8]
                                }
                            },
                            {
                                extend: 'pdf',
                                extend: 'pdfHtml5',
                                orientation: 'landscape',
                                pageSize: 'LEGAL',
                                exportOptions: {
                                    columns: [0, 1, 2, 3, 4, 5, 6, 7, 8]
                                }
                            },
                            {
                                extend: 'print',
                                exportOptions: {
                                    columns: [0, 1, 2, 3, 4, 5, 6, 7, 8]
                                }
                            },
                        ],
                    });

                    $('#invoiceOrders tbody').on('click', 'td.details-control', function() {
                        let tr = $(this).closest('tr');
                        let row = invoiceOrders.row(tr);

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
