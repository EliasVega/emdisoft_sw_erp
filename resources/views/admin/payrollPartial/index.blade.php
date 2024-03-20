@extends("layouts.admin")
@section('titulo')
{{ config('app.name', 'EmdisoftPro') }}
@endsection
@section('content')
<main class="main">
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <h5>Nominas
                @can('payrollPartial.create')
                    <a href="payrollPartial/create" class="btn btn-greenGrad btn-sm"><i class="fa fa-plus"></i> Agregar Nomina</a>
                @endcan

            </h5>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="table-responsive">
                <table class="table table-striped table-bordered table-condensed table-hover" id="payrollPartials">
                    <thead>
                        <tr class="bg-info">
                            <!--<th>O.P</th>-->
                            <th>Id</th>
                            <th>Empleado</th>
                            <th>F/inicio</th>
                            <th>F/fin</th>
                            <th>F/pago</th>
                            <th>F/generacion</th>
                            <th>Devengados</th>
                            <th>acciones</th>
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
        $('#payrollPartials').DataTable(
        {
            responsive: true,
            info: true,
            paging: true,
            ordering: true,
            searching: true,
            autoWidth: false,
            processing: true,
            serverSide: true,
            stateSave: true,
            language: {
                url: "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json"
            },
            ajax: '{{ route('payrollPartial.index') }}',
            columns:
            [
                {data: 'id'},
                {data: 'employee'},
                {data: 'start_date'},
                {data: 'end_date'},
                {data: 'payment_date'},
                {data: 'generation_date'},
                {data: 'total_acrued'},
                {data: 'btn'},
            ],
            dom: 'Blfrtip',
            lengthMenu: [
                [10, 20, 50, 100, 500, -1], [10, 20, 50, 100, 500, 'Todos']
            ],
            buttons: [
                {
                    extend: 'excel',
                    exportOptions: {
                        columns: [ 0, 1, 2, 3, 4, 5, 6 ]
                    }
                },
                {
                    extend: 'pdf',
                    extend: 'pdfHtml5',
                    orientation: 'landscape',
                    pageSize: 'LEGAL',
                    exportOptions: {
                        columns: [ 0, 1, 2, 3, 4, 5, 6 ]
                    }
                },
                {
                    extend: 'print',
                    exportOptions: {
                        columns: [ 0, 1, 2, 3, 4, 5, 6 ]
                    }
                },
            ],
        });
    });
</script>
@endpush
</main>
@endsection






