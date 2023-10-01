@can('verificationCode.edit')
    <a href="{{ route('verificationCode.edit', $id) }}" class="btn btn-warning btn-sm" data-toggle="tooltip"
    data-placement="top" title="Editar"><i class="far fa-edit"></i></a>
@endcan
@can('verificationCode.destroy')
    <a class="btn btn-danger btn-sm" href="" data-target="#modal-delete-{{ $id }}" data-placement="top" data-toggle="modal" title="Eliminar">
        <i class="fas fa-trash fa-fw"></i></a>
@endcan
@include('admin.verificationCode.delete', ['id' => $id])
