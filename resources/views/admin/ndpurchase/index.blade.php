@extends("layouts.admin")
@section('titulo')
{{ config('app.name', 'EmdisoftPro') }}
@endsection
@section('content')
<main class="main">
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <h5>Notas Debito de compras
                @can('purchase.index')
                    <a href="{{ route('purchase.index') }}" class="btn btn-lightBlueGrad btn-sm"><i class="fas fa-undo-alt mr-2"></i>Regresar</a>
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
                <table class="table table-striped table-bordered table-condensed table-hover" id="ndpurchases">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Documento</th>
                            <th>Proveedor</th>
                            <th>Compra N°</th>
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
        print(typeDocument);
        function print(typeDocument) {
            if (typeDocument == 'ndpurchase') {
                var ndpurchase = "{{ $ndpurchase ?? '' }}";
                if (ndpurchase != '') {
                    var imprimir = "{{ route('pdfNdpurchase', ['ndpurchase' => ':ndpurchase']) }}";
                    imprimir = imprimir.replace(':ndpurchase', ndpurchase);
                    window.open(imprimir, "_blank");
                }
            } else if (typeDocument == 'pos') {
                var ndpurchase = "{{ $ndpurchase ?? '' }}";
                if (ndpurchase != '') {
                    var imprimir = "{{ route('posPdfNdpurchase', ['ndpurchase' => ':ndpurchase']) }}";
                    imprimir = imprimir.replace(':ndpurchase', ndpurchase);
                    window.open(imprimir, "_blank");
                }
            } else {

            }
        }
        $('#ndpurchases').DataTable(
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
            ajax: '{{ route('ndpurchase.index') }}',
            order: [[0, "desc"]],
            columns:
            [
                {data: 'id'},
                {data: 'document'},
                {data: 'provider'},
                {data: 'reference'},
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
