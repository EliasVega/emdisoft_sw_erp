@can('environment.edit')
<a href="{{ route('environment.edit', $id) }}" class="btn btn-warning btn-sm" data-toggle="tooltip"
    data-placement="top" title="Editar"><i class="far fa-edit"></i></a>
@endcan
@can('environment.destroy')
<a class="btn btn-danger btn-sm" href="" data-target="#modal-delete-{{ $id }}"
    data-toggle="modal" title="Eliminar"><i class="fas fa-trash fa-fw"></i></a>
@endcan
@include('admin.environment.delete', ['id' => $id])
