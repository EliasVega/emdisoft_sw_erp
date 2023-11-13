
@extends("layouts.admin")
@section('titulo')
{{ config('app.name', 'EmdisoftPro') }}
@endsection
@section('content')
<main class="main">
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            @can('')

            @endcan
            <h5>Indicadores
                @can('company.index')
                    <a href="{{ route('company.index') }}" class="btn btn-blueGrad btn-sm"><i class="fas fa-undo-alt mr-2"></i>Inicio</a>
                @endcan
            </h5>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="table-responsive">
                <table class="table table-striped table-bordered table-condensed table-hover" id="indicators">
                    <thead>
                        <tr>
                            <th>S/Minimo</th>
                            <th>A/trasporte</th>
                            <th>Editar</th>
                            <th>Dian</th>
                            <th>Pos</th>
                            <th>Logo</th>
                            <th>Nomina</th>
                            <th>Cont.</th>
                            <th>Inv.</th>
                            <th>P/Prod</th>
                            <th>M/Primas</th>
                            <th>Rest.</th>
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
        $('#indicators').DataTable(
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
            ajax: '{{ route('indicator.index') }}',
            columns:
            [
                {data: 'smlv', className: 'dt-body-right', render: $.fn.dataTable.render.number( '.', ',', 2, '$')},
                {data: 'transport_assistance', className: 'dt-body-right', render: $.fn.dataTable.render.number( '.', ',', 2, '$')},
                {data: 'edit'},
                {data: 'dian'},
                {data: 'pos'},
                {data: 'logo'},
                {data: 'payroll'},
                {data: 'accounting'},
                {data: 'inventory'},
                {data: 'productPrice'},
                {data: 'rawMaterial'},
                {data: 'restaurant'},
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





