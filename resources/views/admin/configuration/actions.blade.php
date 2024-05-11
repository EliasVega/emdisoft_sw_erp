@can('configuration.edit')
<a href="{{ route('configuration.edit', $id) }}" class="btn btn-warning btn-sm" data-toggle="tooltip"
    data-placement="top" title="Editar"><i class="far fa-edit"></i></a>
@endcan
@can('configuration.show')
    <a href="{{ route('configuration.show', $id) }}" class="btn btn-success btn-sm" data-toggle="tooltip"
    data-placement="top" title="Ver Configuracion"><i class="far fa-eye"></i></a>
@endcan
