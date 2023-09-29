@can('bank.edit')
    <a href="{{ route('bank.edit', $id) }}"
        class="btn btn-warning btn-sm" data-toggle="tooltip" data-placement="top" title="Editar"><i class="far fa-edit"></i>
    </a>
@endcan
@can('bank.destroy')
    <a class="btn btn-danger btn-sm" data-target="#modal-delete-{{ $id }}" data-toggle="modal" href title="Eliminar">
        <i class="fas fa-trash fa-fw"></i>
    </a>
@endcan
@include('admin.bank.delete', ['id' => $id])
