@extends("layouts.admin")
@section('titulo')
{{ config('app.name', 'EmdisoftPro') }}
@endsection
@section('content')
<main class="main">
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <h5>Listado de Compras
                @can('purchase.create')
                    <a href="purchase/create" class="btn btn-greenGrad btn-sm m-2"><i class="fa fa-plus mr-2"></i> Compra Productos</a>
                @endcan
                @if ($indicator->raw_material == 'on')
                    @can('purchase.create')
                        <a href="createRawmaterial" class="btn btn-orangeGrad btn-sm m-2"><i class="fa fa-plus mr-2"></i> Compra Materia Prima</a>
                    @endcan
                @endif
                @if ($indicator->raw_material == 'on')
                    @can('expense.create')
                        <a href="expense/create" class="btn btn-lightBlueGrad btn-sm m-2"><i class="fa fa-plus mr-2"></i> Gastos</a>
                    @endcan
                @endif
                @can('branch.index')
                    <a href="{{ route('branch.index') }}" class="btn btn-blueGrad btn-sm"><i class="fas fa-undo-alt mr-2"></i>Inicio</a>
                @endcan
            </h5>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            @can('provider.index')
                <a href="{{ route('provider.index') }}" class="btn btn-blueGrad btn-sm m-2"><i class="fas fa-undo-alt mr-2"></i>Proveedores</a>
            @endcan
            @can('ncpurchase.index')
                <a href="{{ route('ncpurchase.index') }}" class="btn btn-blueGrad btn-sm m-2"><i class="fas fa-undo-alt mr-2"></i>N.C.</a>
            @endcan
            @can('ndpurchase.index')
                <a href="{{ route('ndpurchase.index') }}" class="btn btn-blueGrad btn-sm m-2"><i class="fas fa-undo-alt mr-2"></i>N.D.</a>
            @endcan
            @can('pay.index')
                <a href="{{ route('pay.index') }}" class="btn btn-blueGrad btn-sm m-2"><i class="fas fa-undo-alt mr-2"></i>Abonos</a>
            @endcan
            @can('advance.index')
                <a href="{{ route('advance.index') }}" class="btn btn-blueGrad btn-sm m-2"><i class="fas fa-undo-alt mr-2"></i>Ant a Proveedores</a>
            @endcan
            @can('purchaseOrder.index')
                <a href="{{ route('purchaseOrder.index') }}" class="btn btn-blueGrad btn-sm m-2"><i class="fas fa-undo-alt mr-2"></i>Orden Compra</a>
            @endcan
            @can('branchProduct.index')
                <a href="{{ route('branchProduct.index') }}" class="btn btn-blueGrad btn-sm m-2"><i class="fas fa-undo-alt mr-2"></i>Productos Sucursal</a>
            @endcan
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="table-responsive">
                <table class="table table-striped table-bordered table-condensed table-hover" id="purchases">
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
                var typeDocument = "{{ $typeDocument ?? '' }}";
                if (typeDocument == 'document') {
                    function print(){
                        var purchase = "{{ $purchase ?? '' }}";
                        if (purchase != '') {
                            var imprimir = "{{ route('pdfPurchase', ['purchase' => ':purchase']) }}";
                            imprimir = imprimir.replace(':purchase', purchase);
                            window.open(imprimir, "_blank");
                        }
                    }
                } else {
                    function print(){
                        var purchase = "{{ $purchase ?? '' }}";
                        if (purchase != '') {
                            var imprimir = "{{ route('posPurchase', ['purchase' => ':purchase']) }}";
                            imprimir = imprimir.replace(':purchase', purchase);
                            window.open(imprimir, "_blank");
                        }
                    }
                }

                print();
                $('#purchases').DataTable(
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
                    ajax: '{{ route('purchase.index') }}',
                    order: [[0, "desc"]],
                    columns:
                    [
                        {data: 'id'},
                        {data: 'provider'},
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
