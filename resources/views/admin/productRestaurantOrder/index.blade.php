@extends("layouts.admin")
@section('titulo')
{{ config('app.name', 'EmdisoftPro') }}
@endsection
@section('content')
<main class="main">
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <h5>Listado de Ventas</h5>
            @can('invoice.create')
                <a href="invoice/create" class="btn btn-greenGrad btn-sm m-2"><i class="fa fa-plus mr-2"></i> Agregar Venta</a>
            @endcan
            @can('branch.index')
                <a href="{{ route('branch.index') }}" class="btn btn-blueGrad btn-sm"><i class="fas fa-undo-alt mr-2"></i>Inicio</a>
            @endcan
            @can('customer.index')
                <a href="{{ route('customer.index') }}" class="btn btn-blueGrad btn-sm m-2"><i class="fas fa-undo-alt mr-2"></i>Clientes</a>
            @endcan
            @can('ncinvoice.index')
                <a href="{{ route('ncinvoice.index') }}" class="btn btn-blueGrad btn-sm m-2"><i class="fas fa-undo-alt mr-2"></i>N.C.</a>
            @endcan
            @can('ndinvoice.index')
                <a href="{{ route('ndinvoice.index') }}" class="btn btn-blueGrad btn-sm m-2"><i class="fas fa-undo-alt mr-2"></i>N.D.</a>
            @endcan
            @can('pay.index')
                <a href="{{ route('pay.index') }}" class="btn btn-blueGrad btn-sm m-2"><i class="fas fa-undo-alt mr-2"></i>Abonos</a>
            @endcan
            @can('advance.index')
                <a href="{{ route('advance.index') }}" class="btn btn-blueGrad btn-sm m-2"><i class="fas fa-undo-alt mr-2"></i>Ant a Proveedores</a>
            @endcan
            @can('prePurchase.index')
                <a href="{{ route('prePurchase.index') }}" class="btn btn-blueGrad btn-sm m-2"><i class="fas fa-undo-alt mr-2"></i>Orden Compra</a>
            @endcan
            @can('branchProduct.index')
                <a href="{{ route('branchProduct.index') }}" class="btn btn-blueGrad btn-sm m-2"><i class="fas fa-undo-alt mr-2"></i>Productos Sucursal</a>
            @endcan
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="table-responsive">
                <table class="table table-striped table-bordered table-condensed table-hover" id="invoices">
                    <thead>
                        <tr class="trdatacolor">
                            <th>Id</th>
                            <th>Proveedor</th>
                            <th>#Fac_Compra</th>
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
            $(document).ready(function ()
            {
                function print(){
                    var invoice = "{{ $invoice ?? '' }}";
                    if (invoice != '') {
                        var imprimir = "{{ route('pdfInvoice', ['invoice' => ':invoice']) }}";
                        imprimir = imprimir.replace(':invoice', invoice);
                        window.open(imprimir, "_blank");
                    }
                }
                print();
                $('#invoices').DataTable(
                {
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
                    order: [[0, "desc"]],
                    columns:
                    [
                        {data: 'id'},
                        {data: 'customer'},
                        {data: 'document'},
                        {data: 'total_pay', className: 'dt-body-right', render: $.fn.dataTable.render.number( '.', ',', 2, '$')},
                        {data: 'pay', className: 'dt-body-right', render: $.fn.dataTable.render.number( '.', ',', 2, '$')},
                        {data: 'retention', className: 'dt-body-right', render: $.fn.dataTable.render.number( '.', ',', 2, '$')},
                        {data: 'balance', className: 'dt-body-right', render: $.fn.dataTable.render.number( '.', ',', 2, '$')},
                        {data: 'grand_total', className: 'dt-body-right', render: $.fn.dataTable.render.number( '.', ',', 2, '$')},
                        {data: 'created_at'},
                        {data: 'status'},
                        {data: 'btn'},
                    ],
                    dom: 'Blfrtip',
                    lengthMenu: [
                        [10, 20, 50, 100, 500, -1], [10, 20, 50, 100, 500, 'Todos']
                    ],
                    buttons: [
                        {
                            extend: 'copy',
                            exportOptions: {
                                columns: [ 0, 1, 2, 3, 4, 5, 6, 7 ]
                            }
                        },
                        {
                            extend: 'excel',
                            exportOptions: {
                                columns: [ 0, 1, 2, 3, 4, 5, 6, 7 ]
                            }
                        },
                        {
                            extend: 'pdf',
                            extend: 'pdfHtml5',
                            orientation: 'landscape',
                            pageSize: 'LEGAL',
                            exportOptions: {
                                columns: [ 0, 1, 2, 3, 4, 5, 6, 7 ]
                            }
                        },
                        {
                            extend: 'print',
                            exportOptions: {
                                columns: [ 0, 1, 2, 3, 4, 5, 6, 7 ]
                            }
                        },
                    ],
                });
            });
        </script>
    @endpush
</main>
@endsection
