@can('category.edit')
    <a href="{{ route('category.edit', $id) }}" class="btn btn-warning" data-toggle="tooltip"
    data-placement="top" title="Editar"><i class="far fa-edit"></i></a>
@endcan
@can('category.categoryStatus')
    @if ($status == 'active')
        <a href="{{ route('categoryStatus', $id) }}" class="btn btn-verde" data-toggle="tooltip"
        data-placement="top" title="Desactivar"><i class="fas fa-icons"></i></a>
    @else
        <a href="{{ route('categoryStatus', $id) }}" class="btn btn-danger" data-toggle="tooltip"
        data-placement="top" title="Activar"><i class="fas fa-icons"></i></a>
    @endif
@endcan
@can('category.destroy')
    <a class="btn btn-danger" data-target="#modal-delete-{{ $id }}" data-toggle="modal" href title="Eliminar">
        <i class="fas fa-trash fa-fw"></i>
    </a>
@endcan
@include('admin.category.delete', ['id' => $id])


