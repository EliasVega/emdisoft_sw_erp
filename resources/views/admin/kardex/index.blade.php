@extends('layouts.admin')
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
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 mb-3">
                                @can('product.index')
                                    <a href="{{ route('branch.index') }}" class="btn btn-lightBlueGrad ml-3"><i
                                            class="fas fa-undo-alt mr-3"></i>Regresar </a>
                                @endcan
                                @can('branch.index')
                                    <a href="{{ route('branch.index') }}" class="btn btn-blueGrad"><i
                                            class="fas fa-undo-alt mr-2"></i>Inicio</a>
                                @endcan
                            </div>
                            <div class="col-12 col-md-2">
                                <input type="date" name="start_date" id="start_date" class="form-control"
                                    max="{{ date('Y-m-d') }}">
                            </div>
                            <div class="col-12 col-md-2">
                                <input type="date" name="end_date" id="end_date" class="form-control"
                                    max="{{ date('Y-m-d') }}">
                            </div>
                            <div class="col-12 col-md-2">
                                <a id="search_button" class="btn btn-primary btn-block">Buscar <i
                                        class="fa-solid fa-magnifying-glass ml-md-1"></i></a>
                            </div>
                            <div class="col-12 col-md-2">
                                <a id="show_all_button" class="btn btn-secondary btn-block">Todos los registros <i
                                        class="fa-solid fa-list ml-md-1"></i></a>
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
                $(document).ready(function() {
                    var table = $('#kardexes').DataTable({
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
                        order: [
                            [0, "desc"]
                        ],
                        columns: [{
                                data: 'document'
                            },
                            {
                                data: 'product_id'
                            },
                            {
                                data: 'branch'
                            },
                            {
                                data: 'operation'
                            },
                            {
                                data: 'created_at'
                            },
                            {
                                data: 'document'
                            },
                            {
                                data: 'product'
                            },
                            {
                                data: 'quantity'
                            },
                            {
                                data: 'stock'
                            },
                        ],
                        dom: 'Blfrtip',
                        lengthMenu: [
                            [10, 20, 50, 100, 500, -1],
                            [10, 20, 50, 100, 500, 'Todos']
                        ],
                        buttons: [{
                                extend: 'copy',
                                exportOptions: {
                                    columns: [0, 1, 2, 3, 4, 5, 6, 7, 8]
                                }
                            },
                            {
                                extend: 'excel',
                                exportOptions: {
                                    columns: [0, 1, 2, 3, 4, 5, 6, 7, 8]
                                }
                            },
                            {
                                extend: 'pdf',
                                extend: 'pdfHtml5',
                                orientation: 'landscape',
                                pageSize: 'LEGAL',
                                exportOptions: {
                                    columns: [0, 1, 2, 3, 4, 5, 6, 7, 8]
                                }
                            },
                            {
                                extend: 'print',
                                exportOptions: {
                                    columns: [0, 1, 2, 3, 4, 5, 6, 7, 8]
                                }
                            },
                        ],
                    });
                    $('#search_button').click(function() {
                        var startDate = $('#start_date').val();
                        var endDate = $('#end_date').val();

                        if (endDate < startDate) {
                            alert('La fecha de fin debe ser mayor que la fecha de inicio');
                            return;
                        }

                        if (startDate != null && endDate != null) {
                            table.ajax.url("{{ route('kardex.index') }}" + "?start_date=" +
                                startDate + "&end_date=" + endDate).load();
                        }
                    });

                    $(document).on('click', '#show_all_button', function() {
                        $('#start_date').val('');
                        $('#end_date').val('');

                        table.ajax.url("{{ route('kardex.index') }}").load();
                    });
                });
            </script>
        @endpush
    </main>
@endsection
