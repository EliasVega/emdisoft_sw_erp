@can('resolution.edit')
    <a href="{{ route('resolution.edit', $id) }}" class="btn btn-primary btn-sm" data-toggle="tooltip"
    data-placement="top" title="Editar"><i class="fas fa-upload"></i></a>
@endcan
<a href="{{ route('resolution.show', $id) }}" class="btn btn-success btn-sm" data-toggle="tooltip"
    data-placement="top" title="Ver Configuracion"><i class="far fa-eye"></i></a>
@can('resolution.destroy')
    <a class="btn btn-danger btn-sm" href="" data-target="#modal-delete-{{ $id }}" data-toggle="modal" title="Eliminar">
        <i class="fas fa-trash fa-1x"></i></a>
@endcan
@include('admin.resolution.delete', ['id' => $id])
