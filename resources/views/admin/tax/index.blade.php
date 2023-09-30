
@extends("layouts.admin")
@section('titulo')
{{ config('app.name', 'EmdisoftPro') }}
@endsection
@section('content')
<main class="main">
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <h5>Impuesto
                @can('tax.create')
                    <a href="tax/create" class="btn btn-greenGrad btn-sm"><i class="fa fa-plus"></i> Agregar Impuesto</a>
                @endcan
                @can('company.index')
                    <a href="{{ route('company.index') }}" class="btn btn-blueGrad btn-sm"><i class="fas fa-undo-alt mr-2"></i>Inicio</a>
                @endcan

            </h5>
        </div>
    </div>
    <div class="text-center py-3">
        <a class="toggle-vis btn btn-sm btn-info" data-column="0">Editar</a>
        <a class="toggle-vis btn btn-sm btn-info" data-column="1">Fecha</a>
        <a class="toggle-vis btn btn-sm btn-info" data-column="2">Id</a>
        <a class="toggle-vis btn btn-sm btn-info" data-column="3">Sucursal</a>
        <a class="toggle-vis btn btn-sm btn-info" data-column="4">Documento</a>
        <a class="toggle-vis btn btn-sm btn-info" data-column="5">Doc. N°</a>
        <a class="toggle-vis btn btn-sm btn-info" data-column="6">Tercero</a>
        <a class="toggle-vis btn btn-sm btn-info" data-column="7">Identificacion</a>
        <a class="toggle-vis btn btn-sm btn-info" data-column="8">Impuesto</a>
        <a class="toggle-vis btn btn-sm btn-info" data-column="9">Porcentage</a>
        <a class="toggle-vis btn btn-sm btn-info" data-column="10">Valor</a>
    </div>
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="table-responsive">
                <table class="table table-striped table-bordered table-condensed table-hover" id="taxes">
                    <thead class="trdatacolor">
                        <tr>
                            <th>Editar</th>
                            <th>Fecha</th>
                            <th>Id</th>
                            <th>Sucursal</th>
                            <th>Documento</th>
                            <th>Num.</th>
                            <th>Tercero</th>
                            <th>Identificacion</th>
                            <th>Impuesto</th>
                            <th>Porcentaje</th>
                            <th>Valor</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th colspan="11" style="text-align:right">Totales:</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
    @push('scripts')
<script type="text/javascript">
$(document).ready(function ()
    {
        var taxes = $('#taxes').DataTable(
        {
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
            ajax: '{{ route('tax.index') }}',
            order: [[8, "desc"]],
            columns:
            [
                {data: 'edit'},
                {data: 'generation_date'},
                {data: 'id'},
                {data: 'branch'},
                {data: 'type'},
                {data: 'document_id'},
                {data: 'third'},
                {data: 'identification'},
                {data: 'taxType'},
                {data: 'percentage'},
                {data: 'tax_value', className: 'dt-body-right', render: $.fn.dataTable.render.number( '.', ',', 2, '$')},


            ],
            dom: 'Bfltip',
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
            drawCallback: function (settings) {
                var api = this.api();
                var rows = api.rows({page: 'current'}).nodes();
                var last = null;
                api.column(8, {page: 'current'}).data().each(function (group, i) {
                    if (last !== group) {
                        $(rows).eq(i).before(
                            `<tr class="bg-secondary"><td colspan="100">${group}</td></tr>`
                        );
                        last = group;
                    }
                });
            },
            footerCallback: function (row, data, start, end, display) {
                var api = this.api(), data;

                var intVal = function (i) {
                    return typeof i === 'string' ?
                        i.replace(/[\$]/g, '').replace(/,/g, '.') * 1 :
                        typeof i === 'number' ?
                            i : 0;
                };

                var total = api
                .column(10)
                .data()
                .reduce(function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0);

                var totalPage = api
                .column(10, {page: 'current'})
                .data()
                .reduce(function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0);
                var formatNumberData = $.fn.dataTable.render.number(',', '.', 0, '').display;
                $(api.column(10).footer()).html(`$ ${formatNumberData(totalPage)} ($ ${formatNumberData( total )})`
                )
            }
        });
        $("a.toggle-vis").on("click", function (e) {
            e.preventDefault();
            var column = taxes.column($(this).data("column"));
            column.visible(!column.visible());
        });
    });
</script>
@endpush
</main>
@endsection
