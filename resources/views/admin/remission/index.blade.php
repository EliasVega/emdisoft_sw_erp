@extends("layouts.admin")
@section('titulo')
{{ config('app.name', 'EmdisoftPro') }}
@endsection
@section('content')
<main class="main">
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <h5>Listado de Ventas</h5>
            <a href="createPosRemission" class="btn btn-blueGrad btn-sm m-2"><i class="fa fa-plus mr-2"></i> Remission pos</a>
            <a href="remission/create" class="btn btn-greenGrad btn-sm m-2"><i class="fa fa-plus mr-2"></i> Agregar Remision</a>
            @can('branch.index')
                <a href="{{ route('branch.index') }}" class="btn btn-blueGrad btn-sm"><i class="fas fa-undo-alt mr-2"></i>Inicio</a>
            @endcan
            @can('customer.index')
                <a href="{{ route('customer.index') }}" class="btn btn-blueGrad btn-sm m-2"><i class="fas fa-undo-alt mr-2"></i>Clientes</a>
            @endcan
            @can('pay.index')
                <a href="{{ route('pay.index') }}" class="btn btn-blueGrad btn-sm m-2"><i class="fas fa-undo-alt mr-2"></i>Abonos</a>
            @endcan
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="table-responsive">
                <table class="table table-striped table-bordered table-condensed table-hover" id="remissions">
                    <thead>
                        <tr class="trdatacolor">
                            <th>Id</th>
                            <th>Cliente</th>
                            <th>#Fac_Compra</th>
                            <th>Valor</th>
                            <th>Abonos</th>
                            <th>Retenciones</th>
                            <th>Saldo</th>
                            <th>Total + NC - ND</th>
                            <th>Fecha</th>
                            <th>Estado</th>
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
                var typeDocument = "{{ $typeDocument ?? '' }}";
                    var dian = "{{ $dian ?? '' }}";
                    function print() {
                        if (typeDocument == 'remission') {
                            var remission = "{{ $remission ?? '' }}";
                            if (remission != '') {
                                var imprimir = "{{ route('pdfRemission', ['remission' => ':remission']) }}";
                                imprimir = imprimir.replace(':remission', remission);
                                window.open(imprimir, "_blank");
                            }
                        } else if (typeDocument == 'remissionPos') {
                            var remission = "{{ $remission ?? '' }}";
                            if (remission != '') {
                                var imprimir = "{{ route('posPdfRemission', ['remission' => ':remission']) }}";
                                imprimir = imprimir.replace(':remission', remission);
                                window.open(imprimir, "_blank");
                            }
                        } else {

                        }
                    }
                    print();
                $('#remissions').DataTable(
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
                    ajax: '{{ route('remission.index') }}',
                    order: [[0, "desc"]],
                    columns:
                    [
                        {data: 'id'},
                        {data: 'customer'},
                        {data: 'document'},
                        {data: 'total_pay', className: 'dt-body-right', render: $.fn.dataTable.render.number( '.', ',', 2, '$')},
                        {data: 'pay', className: 'dt-body-right', render: $.fn.dataTable.render.number( '.', ',', 2, '$')},
                        {data: 'retention', className: 'dt-body-right', render: $.fn.dataTable.render.number( '.', ',', 2, '$')},
                        {data: 'balance', className: 'dt-body-right', render: $.fn.dataTable.render.number( '.', ',', 2, '$')},
                        {data: 'grand_total', className: 'dt-body-right', render: $.fn.dataTable.render.number( '.', ',', 2, '$')},
                        {data: 'created_at'},
                        {data: 'status'},
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
