
@extends("layouts.admin")
@section('titulo')
{{ config('app.name', 'EmdisoftPro') }}
@endsection
@section('content')
<main class="main">
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <h5>Productos
                @can('purchaseOrder.create')
                    <a href="purchaseOrder/create" class="btn btn-greenGrad btn-sm"><i class="fa fa-plus"></i> Agregar Orden de compra</a>
                @endcan
                @can('purchase.index')
                    <a href="{{ route('purchase.index') }}" class="btn btn-blueGrad btn-sm"><i class="fas fa-undo-alt mr-2"></i>Regresar</a>
                @endcan
                @can('branch.index')
                    <a href="{{ route('branch.index') }}" class="btn btn-blueGrad btn-sm"><i class="fas fa-undo-alt mr-2"></i>Inicio</a>
                @endcan
            </h5>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="table-responsive">
                <table class="table table-striped table-bordered table-condensed table-hover" id="purchaseOrders">
                    <thead class="trdatacolor">
                        <tr>
                            <th>Id</th>
                            <th>Proveedor</th>
                            <th>Valor</th>
                            <th>Saldo</th>
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
            var purchaseOrder = "{{ $purchaseOrder ?? '' }}";
            if (purchaseOrder != '') {
                var imprimir = "{{ route('pdfPurchaseOrder', ['purchaseOrder' => ':purchaseOrder']) }}";
                imprimir = imprimir.replace(':purchaseOrder', purchaseOrder);
                window.open(imprimir, "_blank");
            }
        }
        print();
        $('#purchaseOrders').DataTable(
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
            ajax: '{{ route('purchaseOrder.index') }}',
            order: [[0, "desc"]],
            columns:
            [
                {data: 'id'},
                {data: 'provider'},
                {data: 'total_pay', className: 'dt-body-right', render: $.fn.dataTable.render.number( '.', ',', 2, '$')},
                {data: 'balance', className: 'dt-body-right', render: $.fn.dataTable.render.number( '.', ',', 2, '$')},
                {data: 'created_at'},
                {data: 'status'},
                {data: 'btn'},
            ],
            dom: 'Bfltip',
            lengthMenu: [
                [10, 20, 50, 100, 500, -1], [10, 20, 50, 100, 500, 'Todos']
            ],
            buttons: [
                {
                    extend: 'copy',
                    exportOptions: {
                        columns: [ 0, 1, 2, 3, 4, 5 ]
                    }
                },
                {
                    extend: 'excel',
                    exportOptions: {
                        columns: [ 0, 1, 2, 3, 4, 5 ]
                    }
                },
                {
                    extend: 'pdf',
                    extend: 'pdfHtml5',
                    orientation: 'landscape',
                    pageSize: 'LEGAL',
                    exportOptions: {
                        columns: [ 0, 1, 2, 3, 4, 5 ]
                    }
                },
                {
                    extend: 'print',
                    exportOptions: {
                        columns: [ 0, 1, 2, 3, 4, 5 ]
                    }
                },
            ],
        });
    });
</script>
@endpush
</main>
@endsection




