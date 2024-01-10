@extends('layouts.admin')
@section('titulo')
    {{ config('app.name', 'EmdisoftPro') }}
@endsection
@section('content')
    <main class="main">
        <div class="text-center py-3">
            <a class="toggle-vis btn btn-sm btn-info" data-column="0">Id</a>
            <a class="toggle-vis btn btn-sm btn-info" data-column="1">Codigo</a>
            <a class="toggle-vis btn btn-sm btn-info" data-column="2">Nombre</a>
            <a class="toggle-vis btn btn-sm btn-info" data-column="3">Stock</a>
            <a class="toggle-vis btn btn-sm btn-info" data-column="4">Tipo</a>
            <a class="toggle-vis btn btn-sm btn-info" data-column="5">Estado</a>
            <a class="toggle-vis btn btn-sm btn-info" data-column="6">Categoria</a>
            <a class="toggle-vis btn btn-sm btn-info" data-column="7">U/medida</a>
            <a class="toggle-vis btn btn-sm btn-info" data-column="8">F/inicio</a>
            <a class="toggle-vis btn btn-sm btn-info" data-column="9">P/compra</a>
            <a class="toggle-vis btn btn-sm btn-info" data-column="10">P/venta</a>
            <a class="toggle-vis btn btn-sm btn-info" data-column="11">V/inventario</a>
            <a class="toggle-vis btn btn-sm btn-info" data-column="12">V/comercial</a>

        </div>
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-condensed table-hover" id="products">
                        <thead class="trdatacolor">
                            <tr>
                                <th>Id</th>
                                <th>Codigo</th>
                                <!--
                                <th>Nombre</th>
                                <th>Stock</th>
                                <th>Tipo</th>
                                <th>Estado</th>
                                <th>Categoria</th>
                                <th>U/medida</th>
                                <th>F/inicio</th>
                                <th>P/compra</th>
                                <th>P/venta</th>
                                <th>V/inventario</th>
                                <th>V/comercial</th>
                                -->
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th colspan="1" style="text-align:right">Totales:</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
        @push('scripts')
            <script type="text/javascript">
                $(document).ready(function() {
                    var products = $('#products').DataTable({
                        info: true,
                        paging: true,
                        ordering: true,
                        searching: true,
                        responsive: true,
                        autoWidth: true,
                        processing: true,
                        serverSide: true,
                        stateSave: true,
                        language: {
                            url: "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json"
                        },
                        ajax: '{{ route('reportInventory') }}',
                        order: [
                            [0, "desc"]
                        ],
                        columns: [{
                                data: 'id'
                            },
                            {
                                data: 'code'
                            },/*
                            {
                                data: 'nombre'
                            },
                            {
                                data: 'stock'
                            },
                            {
                                data: 'type'
                            },
                            {
                                data: 'status'
                            },
                            {
                                data: 'category'
                            },
                            {
                                data: 'measure_unit'
                            },
                            {
                                data: 'created_at'
                            },
                            {
                                data: 'price',
                                className: 'dt-body-right',
                                render: $.fn.dataTable.render.number('.', ',', 2, '$')
                            },
                            {
                                data: 'sale_price',
                                className: 'dt-body-right',
                                render: $.fn.dataTable.render.number('.', ',', 2, '$')
                            },
                            {
                                data: 'inventoryValue',
                                className: 'dt-body-right',
                                render: $.fn.dataTable.render.number('.', ',', 2, '$')
                            },
                            {
                                data: 'comercialValue',
                                className: 'dt-body-right',
                                render: $.fn.dataTable.render.number('.', ',', 2, '$')
                            },*/

                        ],
                        dom: 'Bfltip',
                        lengthMenu: [
                            [10, 20, 50, 100, 500, -1],
                            [10, 20, 50, 100, 500, 'Todos']
                        ],
                        buttons: [{
                                extend: 'copy',
                                exportOptions: {
                                    columns: [0, 1]
                                }
                            },
                            {
                                extend: 'excel',
                                exportOptions: {
                                    columns: [0, 1]
                                }
                            },
                            {
                                extend: 'pdf',
                                extend: 'pdfHtml5',
                                orientation: 'landscape',
                                pageSize: 'LEGAL',
                                exportOptions: {
                                    columns: [0, 1]
                                }
                            },
                            {
                                extend: 'print',
                                exportOptions: {
                                    columns: [0, 1]
                                }
                            },
                        ],
                    });
                });
            </script>
        @endpush
    </main>
@endsection
