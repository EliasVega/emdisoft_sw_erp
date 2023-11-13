
@extends("layouts.admin")
@section('titulo')
{{ config('app.name', 'EmdisoftPro') }}
@endsection
@section('content')
<main class="main">
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <h5>Productos
                @can('rawMaterial.create')
                    <a href="rawMaterial/create" class="btn btn-greenGrad btn-sm"><i class="fa fa-plus"></i> Agregar Materia Prima</a>
                @endcan
                @can('branch.index')
                    <a href="{{ route('branch.index') }}" class="btn btn-blueGrad btn-sm"><i class="fas fa-undo-alt mr-2"></i>Inicio</a>
                @endcan
                @can('branchProduct.index')
                    <a href="{{ route('branchRawmaterial.index') }}" class="btn btn-orangeGrad btn-sm"><i class="fas fa-undo-alt mr-2"></i>Producto Sucursal</a>
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
                <table class="table table-striped table-bordered table-condensed table-hover" id="rawMaterials">
                    <thead class="trdatacolor">
                        <tr>
                            <th>Id</th>
                            <th>Tipo</th>
                            <th>Categoria</th>
                            <th>Codigo</th>
                            <th>Nombre</th>
                            <th>Prcio</th>
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
        $('#rawMaterials').DataTable(
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
            ajax: '{{ route('rawMaterial.index') }}',
            order: [[0, "desc"]],
            columns:
            [
                { data: 'id'},
                { data: 'type_product'},
                { data: 'category'},
                { data: 'code'},
                { data: 'name'},
                { data: 'price'},
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
