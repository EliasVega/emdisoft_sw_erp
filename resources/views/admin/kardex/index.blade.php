@extends("layouts.admin")
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
                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                            <input type="text" name="start" id="start" class="form-control" value="2021-01-01" placeholder="Fecha Inicial"/>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                            <input type="text" name="end" id="end" class="form-control" value="" placeholder="Fecha Final"/>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                            <a type="button" name="filter" id="filter" class="btn btn-lila">Filtrar</a>
                            <a type="button" name="refresh" id="refresh" class="btn btn-ver">Refrescar</a>
                            @can('product.index')
                                <a href="{{ route('branch.index') }}" class="btn btn-lightBlueGrad ml-3"><i class="fas fa-undo-alt mr-3"></i>Regresar </a>
                            @endcan
                            @can('branch.index')
                                <a href="{{ route('branch.index') }}" class="btn btn-blueGrad"><i class="fas fa-undo-alt mr-2"></i>Inicio</a>
                            @endcan
                        </div>
                    </div>
                </div>
                <br>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="table-responsive">
                <table class="table table-striped table-bordered table-condensed table-hover" id="kardexes">
                    <thead>
                        <tr>
                            <th>Doc.</th>
                            <th>Pro.ID</th>
                            <th>Sucursal</th>
                            <th>Operacion</th>
                            <th>Fecha</th>
                            <th>Oper.#</th>
                            <th>Producto</th>
                            <th>Cantidad</th>
                            <th>Stock</th>
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
        $('#kardexes').DataTable(
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
            ajax: '{{ route('kardex.index') }}',
            order: [[0, "desc"]],
            columns:
            [
                { data: 'document'},
                { data: 'product_id'},
                { data: 'branch'},
                { data: 'operation'},
                { data: 'created_at'},
                { data: 'document'},
                { data: 'product'},
                { data: 'quantity'},
                { data: 'stock'},
            ],
            dom: 'Blfrtip',
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
