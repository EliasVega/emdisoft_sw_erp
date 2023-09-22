@can('branch.edit')
    <a href="{{ route('branch.edit', $id) }}" class="btn btn-warning btn-sm" data-toggle="tooltip"
    data-placement="top" title="Editar"><i class="far fa-edit"></i></a>
@endcan
@can('branch.show')
    <a href="{{ route('branch.show', $id) }}" class="btn btn-primary btn-sm" data-toggle="tooltip"
    data-placement="top" title="Ver Sucursal"><i class="far fa-eye"></i></a>
@endcan
@can('branch.destroy')
    <a class="btn btn-danger btn-sm" data-target="#modal-delete-{{ $id }}" data-toggle="modal" href title="Eliminar">
        <i class="fas fa-trash fa-fw"></i></a>
@endcan
@include('admin.branch.delete', ['id' => $id])


