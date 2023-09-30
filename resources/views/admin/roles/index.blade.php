@extends("layouts.admin")
@section('titulo')
    {{ config('app.name', 'EmdisoftPro') }}
@endsection
@section('content')
<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <h5>Listado de Roles
            @can('rol.create')
                <a href="roles/create"><button class="btn btn-greenGrad btn-sm"><i class="fa fa-plus"></i> Agregar Rol</button></a>
            @endcan
            @can('branch.index')
                <a href="{{ route('company.index') }}" class="btn btn-blueGrad btn-sm"><i class="fas fa-undo-alt mr-2"></i>Inicio</a>
            @endcan
        </h5>
    </div>
</div>
<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="table-responsive">
            <table class="table table-striped table-bordered table-condensed table-hover" id="roles">
                <thead class="trdatacolor">
                    <tr>
                        <th>Id</th>
                        <th>Rol</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>
@endsection
@section('scripts')
<script>
    $(document).ready(function()
    {
        $('#roles').DataTable({
            responsive: true,
            autoWidth: false,
        processing: true,
        serverSider: true,
        ajax: '{{ route('roles.index') }}',

        columns: [
        {data: 'id'},
        {data: 'name'},
        {data: 'edit'},
        ],
        dom: 'Bfrtilp',

        buttons: [
            'excel', 'pdf',
        ],
        "language":
        {
            "processing": "Cargando...",
            "lengthMenu": "Mostrar _MENU_ registros",
            "zeroRecords": "No se encontraron resultados",
            "emptyTable": "Ningún dato disponible en esta tabla",
            "info": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
            "infoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
            "infoFiltered": "(Filtrado de un total de _MAX_ registros)",
            "search": "Buscar:",
            "loadingRecords": "Cargando...",
            "paginate": {
                "next": "Siguiente",
                "previous": "Anterior",
            },

            "buttons": {
                "copy": "Copiar",
                "print": "Imprimir"
            }
        },
    });

});
</script>
@endsection



