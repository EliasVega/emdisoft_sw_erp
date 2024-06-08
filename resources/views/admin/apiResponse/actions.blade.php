
<a class="btn btn-danger btn-sm" href="" data-target="#modal-delete-{{ $id }}" data-toggle="modal" title="Eliminar">
    <i class="fas fa-trash fa-fw"></i></a>
@include('admin.apiResponse.delete', ['id' => $id])
