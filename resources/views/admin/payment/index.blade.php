@extends("layouts.admin")
@section('titulo')
{{ config('app.name', 'EmdisoftPro') }}
@endsection
@section('content')
<main class="main">
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <h5>Listado de Abonos
                @can('branch.index')
                 <a href="{{ route('branch.index') }}" class="btn btn-blueGrad btn-sm"><i class="fas fa-undo-alt mr-2"></i>Inicio</a>
                @endcan
                @can('customer.index')
                 <a href="{{ route('customer.index') }}" class="btn btn-blueGrad btn-sm"><i class="fas fa-undo-alt mr-2"></i>Clientes</a>
                @endcan
                @can('provider.index')
                 <a href="{{ route('provider.index') }}" class="btn btn-blueGrad btn-sm"><i class="fas fa-undo-alt mr-2"></i>Proveedores</a>
                @endcan
             </h5>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="table-responsive">
                <table class="table table-striped table-bordered table-condensed table-hover" id="payments">
                    <thead>
                        <tr class="bg-info">
                            <th>ID</th>
                            <th>Identificacion</th>
                            <th>Tipo</th>
                            <th>Tercero</th>
                            <th>Sede</th>
                            <th>Responsable</th>
                            <th>Abono</th>
                            <th>Fecha</th>
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
                $('#payments').DataTable(
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
                    ajax: '{{ route('payment.index') }}',
                    order: [[0, "desc"]],
                    columns:
                    [
                        {data: 'id'},
                        {data: 'identification'},
                        {data: 'type_third'},
                        {data: 'third'},
                        {data: 'branch'},
                        {data: 'user'},
                        {data: 'pay', render: $.fn.dataTable.render.number( '.', ',', 2) },
                        {data: 'created_at'},
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
                                columns: [ 0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10 ]
                            }
                        },
                        {
                            extend: 'excel',
                            exportOptions: {
                                columns: [ 0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10 ]
                            }
                        },
                        {
                            extend: 'pdf',
                            extend: 'pdfHtml5',
                            orientation: 'landscape',
                            pageSize: 'LEGAL',
                            exportOptions: {
                                columns: [ 0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10 ]
                            }
                        },
                        {
                            extend: 'print',
                            exportOptions: {
                                columns: [ 0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10 ]
                            }
                        },
                    ],
                });
            });
        </script>
    @endpush
</main>
@endsection





