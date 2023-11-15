@extends("layouts.admin")
@section('titulo')
{{ config('app.name', 'EmdisoftPro') }}
@endsection
@section('content')
<main class="main">
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <h5>Sucursales
                @can('branch.create')
                    <a href="branch/create" class="btn btn-greenGrad btn-sm"><i class="fa fa-plus"></i> Agregar Sucursal</a>
                @endcan
                @can('company.index')
                    <a href="{{ route('company.index') }}" class="btn btn-blueGrad btn-sm"><i class="fas fa-undo-alt mr-2"></i>Regresar</a>
                @endcan
                @can('product.index')
                    <a href="{{ route('product.index') }}" class="btn btn-blueGrad btn-sm m-2"><i class="fas fa-undo-alt mr-2"></i>Productos</a>
                @endcan
                @if ($rawMaterial == 'on')
                    @can('rawMaterial.index')
                        <a href="{{ route('rawMaterial.index') }}" class="btn btn-orangeGrad btn-sm m-2"><i class="fas fa-undo-alt mr-2"></i>Materias primas</a>
                    @endcan
                @endif

            </h5>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="table-responsive">
                <table class="table table-striped table-bordered table-condensed table-hover" id="branches">
                    <thead>
                        <tr class="bg-info">
                            <!--<th>O.P</th>-->
                            <th>Operatciones</th>
                            <th>Id</th>
                            <th>Departamento</th>
                            <th>Municipio</th>
                            <th>Sucursal</th>
                            <th>Nit</th>
                            <th>acciones</th>
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
        $('#branches').DataTable(
        {
            responsive: true,
            info: true,
            paging: true,
            ordering: true,
            searching: true,
            autoWidth: false,
            processing: true,
            serverSide: true,
            stateSave: true,
            language: {
                url: "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json"
            },
            ajax: '{{ route('branch.index') }}',
            columns:
            [
                {data: 'btn'},
                {data: 'id'},
                {data: 'department'},
                {data: 'municipality'},
                {data: 'name'},
                {data: 'company'},
                {data: 'accesos'},
            ],
            dom: 'Blfrtip',
            lengthMenu: [
                [10, 20, 50, 100, 500, -1], [10, 20, 50, 100, 500, 'Todos']
            ],
            buttons: [
                {
                    extend: 'excel',
                    exportOptions: {
                        columns: [ 0, 1, 2, 3, 4, 5, 6 ]
                    }
                },
                {
                    extend: 'pdf',
                    extend: 'pdfHtml5',
                    orientation: 'landscape',
                    pageSize: 'LEGAL',
                    exportOptions: {
                        columns: [ 0, 1, 2, 3, 4, 5, 6 ]
                    }
                },
                {
                    extend: 'print',
                    exportOptions: {
                        columns: [ 0, 1, 2, 3, 4, 5, 6 ]
                    }
                },
            ],
        });
    });
</script>
@endpush
</main>
@endsection






