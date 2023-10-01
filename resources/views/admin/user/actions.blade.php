@can('user.edit')
    <a href="{{ route('user.edit', $id) }}" class="btn btn-warning btn-sm" data-toggle="tooltip"
    data-placement="top" title="Editar"><i class="far fa-edit"></i></a>
@endcan
@can('user.status')
    <a href="{{ route('status', $id) }}" class="btn btn-success btn-sm" data-toggle="tooltip"
    data-placement="top" title="Desactivar"><i class="fas fa-user"></i></a>
@endcan
@can('user.destroy')
    <a class="btn btn-danger btn-sm" href="" data-target="#modal-delete-{{ $id }}" data-placement="top" data-toggle="modal" title="Eliminar">
        <i class="fas fa-trash"></i></a>
@endcan
@include('admin.user.delete', ['id' => $id])
