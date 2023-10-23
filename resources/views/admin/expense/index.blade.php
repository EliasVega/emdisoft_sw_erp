@extends("layouts.admin")
@section('titulo')
{{ config('app.name', 'EmdisoftPro') }}
@endsection
@section('content')
<main class="main">
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <h5>Listado de Gastos</h5>
            @can('expense.create')
                <a href="expense/create" class="btn btn-greenGrad btn-sm m-2"><i class="fa fa-plus mr-2"></i> Agregar Gasto</a>
            @endcan
            @can('branch.index')
                <a href="{{ route('branch.index') }}" class="btn btn-blueGrad btn-sm m-2"><i class="fas fa-undo-alt mr-2"></i>Inicio</a>
            @endcan
            @can('provider.index')
                <a href="{{ route('provider.index') }}" class="btn btn-blueGrad btn-sm m-2"><i class="fas fa-undo-alt mr-2"></i>Proveedores</a>
            @endcan
            @can('pay.index')
                <a href="{{ route('pay.index') }}" class="btn btn-blueGrad btn-sm m-2"><i class="fas fa-undo-alt mr-2"></i>Abonos</a>
            @endcan
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="table-responsive">
                <table class="table table-striped table-bordered table-condensed table-hover" id="expenses">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Sucursal</th>
                            <th>Proveedor</th>
                            <th>Gasto</th>
                            <th>Valor</th>
                            <th>Abonos</th>
                            <th>Saldo</th>
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
        window.onload = function() {
            var expense = "{{ $expense ?? '' }}";
            if (expense != '') {
                var imprimir = "{{ route('posExpense', ['expense' => ':expense']) }}";
                imprimir = imprimir.replace(':expense', expense);
                window.open(imprimir, "_blank");
            }
        }
        $('#expenses').DataTable(
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
            ajax: '{{ route('expense.index') }}',
            order: [[0, "desc"]],
            columns:
            [
                {data: 'id'},
                {data: 'branch'},
                {data: 'provider'},
                {data: 'document'},
                {data: 'total_pay', className: 'dt-body-right', render: $.fn.dataTable.render.number( '.', ',', 2, '$')},
                {data: 'pay', className: 'dt-body-right', render: $.fn.dataTable.render.number( '.', ',', 2, '$')},
                {data: 'balance', className: 'dt-body-right', render: $.fn.dataTable.render.number( '.', ',', 2, '$')},
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
