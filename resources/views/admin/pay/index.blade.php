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
                @can('purchase.index')
                 <a href="{{ route('purchase.index') }}" class="btn btn-blueGrad btn-sm"><i class="fas fa-undo-alt mr-2"></i>Compras</a>
                @endcan
                @can('invoice.index')
                 <a href="{{ route('invoice.index') }}" class="btn btn-blueGrad btn-sm"><i class="fas fa-undo-alt mr-2"></i>Ventas</a>
                @endcan
             </h5>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="table-responsive">
                <table class="table table-striped table-bordered table-condensed table-hover" id="pays">
                    <thead>
                        <tr class="bg-info">
                            <th>ID</th>
                            <!--
                            <th>Documento</th>
                            <th>Tipo</th>
                            <th>Tercero</th>
                            <th>Sede</th>
                            <th>Responsable</th>
                            <th>V/Factura.</th>-->
                            <th>Abono</th>
                            <th>Saldo</th>
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
                $('#pays').DataTable(
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
                    ajax: '{{ route('pay.index') }}',
                    order: [[0, "desc"]],
                    columns:
                    [
                        {data: 'id'},/*
                        {data: 'document'},
                        {data: 'type'},
                        {data: 'third'},
                        {data: 'branch'},
                        {data: 'user'},
                        {data: 'total_pay', render: $.fn.dataTable.render.number( '.', ',', 2)},*/
                        {data: 'pay', render: $.fn.dataTable.render.number( '.', ',', 2) },
                        {data: 'balance', render: $.fn.dataTable.render.number( '.', ',', 2)},
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
                                columns: [ 0, 1, 2, 3, 4, 5, 6, 7, 8 ]
                            }
                        },
                        {
                            extend: 'excel',
                            exportOptions: {
                                columns: [ 0, 1, 2, 3, 4, 5, 6, 7, 8 ]
                            }
                        },
                        {
                            extend: 'pdf',
                            extend: 'pdfHtml5',
                            orientation: 'landscape',
                            pageSize: 'LEGAL',
                            exportOptions: {
                                columns: [ 0, 1, 2, 3, 4, 5, 6, 7, 8 ]
                            }
                        },
                        {
                            extend: 'print',
                            exportOptions: {
                                columns: [ 0, 1, 2, 3, 4, 5, 6, 7, 8 ]
                            }
                        },
                    ],
                });
            });
        </script>
    @endpush
</main>
@endsection





