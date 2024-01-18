
<a href="{{ route('product.edit', $id) }}" class="btn btn-warning btn-sm" data-toggle="tooltip"
data-placement="top" title="Editar"><i class="far fa-edit"></i></a>

<a href="{{ route('product.show', $id) }}" class="btn btn-success btn-sm" data-toggle="tooltip"
data-placement="top" title="ver"><i class="far fa-eye"></i></a>

@if ($status == 'active')
    <a href="{{ route('productStatus', $id) }}" class="btn btn-verde btn-sm" data-toggle="tooltip"
    data-placement="top" title="Desactivar"><i class="fas fa-icons"></i></a>
@else
    <a href="{{ route('productStatus', $id) }}" class="btn btn-danger btn-sm" data-toggle="tooltip"
    data-placement="top" title="Activar"><i class="fas fa-icons"></i></a>
@endif


<a class="btn btn-danger btn-sm" href="" data-target="#modal-delete-{{ $id }}" data-toggle="modal" title="Eliminar">
    <i class="fas fa-trash fa-fw"></i></a>

@include('admin.product.delete', ['id' => $id])
