<a href="{{ route('puc.edit', $id) }}" class="btn bg-primary"  title="Editar">
    <i class="fas fa-edit fa-fw"></i>
</a>
<a class="btn btn-danger" href="" data-target="#modal-delete-{{ $id }}" data-toggle="modal" title="Eliminar">
    <i class="fas fa-trash fa-fw"></i>
</a>
@include('admin.puc.delete', ['id' => $id])
