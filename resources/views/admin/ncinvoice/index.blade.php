@extends("layouts.admin")
@section('titulo')
{{ config('app.name', 'EmdisoftPro') }}
@endsection
@section('content')
<main class="main">
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <h5>Notas Credito de Ventas
                @can('invoice.index')
                    <a href="{{ route('invoice.index') }}" class="btn btn-lightBlueGrad btn-sm"><i class="fas fa-undo-alt mr-2"></i>Regresar</a>
                @endcan
                @can('branch.index')
                    <a href="{{ route('branch.index') }}" class="btn btn-blueGrad btn-sm"><i class="fas fa-undo-alt mr-2"></i>Inicio</a>
                @endcan
            </h5>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="table-responsive">
                <table class="table table-striped table-bordered table-condensed table-hover" id="ncinvoices">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Sucursal</th>
                            <th>Proveedor</th>
                            <th>Venta N°</th>
                            <th>V/Total</th>
                            <th>Responsable</th>
                            <th>Fecha_NC</th>
                            <th>editar</th>
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
        var documentType = "{{ $documentType ?? '' }}";
        function print(){
            if ($documentType == 1) {
                var ncinvoice = "{{ $ncinvoice ?? '' }}";
                if (ncinvoice != '') {
                    var imprimir = "{{ route('pdfNcinvoice', ['ncinvoice' => ':ncinvoice']) }}";
                    imprimir = imprimir.replace(':ncinvoice', ncinvoice);
                    window.open(imprimir, "_blank");
                }
            } else if (documentType == 15){
                var ncinvoice = "{{ $ncinvoice ?? '' }}";
                if (dian == 'on') {
                    if (ncinvoice != '') {
                        var imprimir = "{{ route('posPdfNcinvoice', ['ncinvoice' => ':ncinvoice']) }}";
                        imprimir = imprimir.replace(':ncinvoice', ncinvoice);
                        window.open(imprimir, "_blank");
                    }
                } else {
                    if (ncinvoice != '') {
                        var imprimir = "{{ route('posNcinvoice', ['ncinvoice' => ':ncinvoice']) }}";
                        imprimir = imprimir.replace(':ncinvoice', ncinvoice);
                        window.open(imprimir, "_blank");
                    }
                }
            }
        }
        print();
        $('#ncinvoices').DataTable(
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
            ajax: '{{ route('ncinvoice.index') }}',
            order: [[0, "desc"]],
            columns:
            [
                {data: 'id'},
                {data: 'branch'},
                {data: 'customer'},
                {data: 'document'},
                {data: 'total_pay', render: $.fn.dataTable.render.number( '.', ',', 2)},
                {data: 'user'},
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
                        columns: [ 0, 1, 2, 3, 4, 5, 6, 7 ]
                    }
                },
                {
                    extend: 'excel',
                    exportOptions: {
                        columns: [ 0, 1, 2, 3, 4, 5, 6, 7 ]
                    }
                },
                {
                    extend: 'pdf',
                    extend: 'pdfHtml5',
                    orientation: 'landscape',
                    pageSize: 'LEGAL',
                    exportOptions: {
                        columns: [ 0, 1, 2, 3, 4, 5, 6, 7 ]
                    }
                },
                {
                    extend: 'print',
                    exportOptions: {
                        columns: [ 0, 1, 2, 3, 4, 5, 6, 7 ]
                    }
                },
            ],
        });
    });
</script>
@endpush
</main>
@endsection
