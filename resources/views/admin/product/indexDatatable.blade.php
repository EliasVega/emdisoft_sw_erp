
@extends("layouts.admin")
@section('titulo')
{{ config('app.name', 'EmdisoftPro') }}
@endsection
@section('content')
<main class="main">
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <h5>Productos
                @can('product.create')
                    <a href="product/create" class="btn btn-greenGrad btn-sm"><i class="fa fa-plus"></i> Agregar Producto</a>
                @endcan
                @can('branch.index')
                    <a href="{{ route('branch.index') }}" class="btn btn-blueGrad btn-sm"><i class="fas fa-undo-alt mr-2"></i>Inicio</a>
                @endcan
                @can('branchProduct.index')
                    <a href="{{ route('branchProduct.index') }}" class="btn btn-blueGrad btn-sm"><i class="fas fa-undo-alt mr-2"></i>Producto Sucursal</a>
                @endcan
                @can('kardex.index')
                    <a href="{{ route('kardex.index') }}" class="btn btn-greenGrad btn-sm"><i class="fas fa-undo-alt mr-2"></i>Kardex</a>
                @endcan
            </h5>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="table-responsive">
                <table class="table table-striped table-bordered table-condensed table-hover" id="products">
                    <thead class="trdatacolor">
                        <tr>
                            <th>Id</th>
                            <th>Imagen</th>
                            <th>Tipo</th>
                            <th>Categoria</th>
                            <th>Codigo</th>
                            <th>Nombre</th>
                            <th>Prcio</th>
                            <th>Precio_Venta</th>
                            <th>% IVA</th>
                            <th>stock</th>
                            <th>Editar</th>
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
        $('#products').DataTable(
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
            ajax: '{{ route('product.index') }}',
            order: [[0, "desc"]],
            columns:
            [
                { data: 'id'},
                {data: 'image',
                    'sortable': false,
                    'searchable': false,
                    'render': function (image) {
                    if (!image) {
                        return 'N/A';
                    } else {
                        var img = image;
                        return '<img src="' + img + '" height="50px" width="50px" />';
                    }
                }},
                { data: 'type_product'},
                { data: 'category'},
                { data: 'code'},
                { data: 'name'},
                { data: 'price'},
                { data: 'sale_price'},
                { data: 'tax_rate'},
                { data: 'stock'},
                { data: 'edit'},
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
