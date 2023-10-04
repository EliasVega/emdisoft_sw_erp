
@extends("layouts.admin")
@section('titulo')
{{ config('app.name', 'EmdisoftPro') }}
@endsection
@section('content')
<main class="main">
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <h5>Porcentages
                @can('percentage.create')
                    <a href="percentage/create" class="btn btn-greenGrad btn-sm"><i class="fa fa-plus"></i>Agregar Porcentage</a>
                @endcan
                @can('company.index')
                    <a href="{{ route('company.index') }}" class="btn btn-blueGrad btn-sm"><i class="fas fa-undo-alt mr-2"></i>Inicio</a>
                @endcan
            </h5>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="table-responsive">
                <table class="table table-striped table-bordered table-condensed table-hover" id="percentages">
                    <thead>
                        <tr class="trdatacolor">
                            <th>Id</th>
                            <th></th>
                            <th>%</th>
                            <th>Base</th>
                            <th>Base UVT</th>
                            <th>Nombre</th>
                            <th>editar</th>
                            <th>Estado</th>
                            <th>Eliminar</th>

                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
    @push('scripts')
<script type="text/javascript">
function format(d) {
    return `
            <table cellpadding="5" cellspacing="0" border="0" style="padding-left:50px;">
                <tr>
                    <td>Concepto</td>
                    <td>${d.concept}</td>
                </tr>
            </table>
        `;
    }
$(document).ready(function ()
    {
        const percentagesTable = $('#percentages').DataTable(
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
            ajax: '{{ route('percentage.index') }}',
            order: [[0, 'desc']],
            columns:
            [
                {data: 'id'},
                {
                    className: 'details-control',
                    orderable: false,
                    data: null,
                    defaultContent: ''
                },
                {data: 'percentage'},
                {data: 'base'},
                {data: 'base_uvt'},
                {data: 'name'},
                {data: 'edit', orderable:false, searchable:false},
                {data: 'status', orderable:false, searchable:false},
                {data: 'destroy', orderable:false, searchable:false},
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
        $('#percentages tbody').on('click', 'td.details-control', function () {
            let tr = $(this).closest('tr');
            let row = percentagesTable.row(tr);

            if (row.child.isShown()) {
                row.child.hide();
                tr.removeClass('shown');
            } else {
                row.child(format(row.data())).show();
                tr.addClass('shown');
            }
        });
    });
</script>
@endpush
</main>
@endsection
