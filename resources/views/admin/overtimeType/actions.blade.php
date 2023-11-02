@can('overtimeType.edit')
    <a href="{{ route('overtimeType.edit', $id) }}" class="btn btn-warning btn-sm" data-toggle="tooltip"
    data-placement="top" title="Editar"><i class="far fa-edit"></i></a>
@endcan
@can('overtimeType.destroy')
    <a class="btn btn-danger btn-sm permanent-btn-iframe-close" href="" data-target="#modal-delete-{{ $id }}" data-toggle="modal" title="Eliminar">
        <i class="fas fa-trash fa-fw"></i></a>
@endcan
@include('admin.overtimeType.delete', ['id' => $id])
