
@extends("layouts.admin")
@section('titulo')
{{ config('app.name', 'EmdisoftPro') }}
@endsection
@section('content')
<main class="main">
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <h5>Resoluciones
                @can('resolution.create')
                    <a href="resolution/create" class="btn btn-greenGrad btn-sm"><i class="fa fa-plus"></i>Agregar Resolucion</a>
                @endcan
                    <a href="downloadResolution" class="btn btn-greenGrad btn-sm"><i class="fa fa-plus"></i>Descarga Resoluciones</a>
                @can('branch.index')
                    <a href="{{ route('branch.index') }}" class="btn btn-blueGrad btn-sm"><i class="fas fa-undo-alt mr-2"></i>Inicio</a>
                @endcan

            </h5>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="table-responsive">
                <table class="table table-striped table-bordered table-condensed table-hover" id="resolutions">
                    <thead class="trdatacolor">
                        <tr>
                            <th>Id</th>
                            <th>Documento</th>
                            <th>Resolucion</th>
                            <th>Pref.</th>
                            <th>Desde</th>
                            <th>Hasta</th>
                            <th>Consecutivo</th>
                            <th>Fecha Inicio</th>
                            <th>Fecha Fin</th>
                            <th>estado</th>
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
        $('#resolutions').DataTable(
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
            ajax: '{{ route('resolution.index') }}',
            order: [[0, "desc"]],
            columns:
            [
                {data: 'id'},
                {data: 'document'},
                {data: 'resolution'},
                {data: 'prefix'},
                {data: 'start_number'},
                {data: 'end_number'},
                {data: 'consecutive'},
                {data: 'start_date'},
                {data: 'end_date'},
                {data: 'status'},
                {data: 'edit'},
            ],
            columnDefs: [{ width: 300, targets: 1 }],
            dom: 'Blfrtip',
            lengthMenu: [
                [10, 20, 50, 100, 500, -1], [10, 20, 50, 100, 500, 'Todos']
            ],
            buttons: [
                {
                    extend: 'copy',
                    exportOptions: {
                        columns: [ 0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12]
                    }
                },
                {
                    extend: 'excel',
                    exportOptions: {
                        columns: [ 0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12 ]
                    }
                },
                {
                    extend: 'pdf',
                    extend: 'pdfHtml5',
                    orientation: 'landscape',
                    pageSize: 'LEGAL',
                    exportOptions: {
                        columns: [ 0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12 ]
                    }
                },
                {
                    extend: 'print',
                    exportOptions: {
                        columns: [ 0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12 ]
                    }
                },
            ],
        });
    });
</script>
@endpush
</main>
@endsection
