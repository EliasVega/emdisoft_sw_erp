@can('employeeType.edit')
    <a href="{{ route('employeeType.edit', $id) }}" class="btn btn-warning"
    data-toggle="tooltip" data-placement="top" title="Editar"><i class="far fa-edit"></i></a>
@endcan
@can('employeeType.destroy')
    <a class="btn btn-danger" href="" data-target="#modal-delete-{{ $id }}" data-toggle="modal"
    title="Eliminar"><i class="fas fa-trash fa-fw"></i></a>
@endcan
@include('admin.employeeType.delete', ['id' => $id])
