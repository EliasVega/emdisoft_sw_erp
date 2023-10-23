@can('product.edit')
    <a href="{{ route('product.edit', $id) }}" class="btn btn-warning btn-sm" data-toggle="tooltip"
    data-placement="top" title="Editar"><i class="far fa-edit"></i></a>
@endcan
@can('kardex.kardexProduct')
    <a href="{{ route('kardexProduct', $id) }}" class="btn btn-limon btn-sm" data-toggle="tooltip"
        data-placement="top" title="kardex"><i class="fas fa-undo-alt"> Kardex Producto</i></a>

@endcan
@can('product.productStatus')
    @if ($status == 'active')
        <a href="{{ route('productStatus', $id) }}" class="btn btn-verde" data-toggle="tooltip"
        data-placement="top" title="Desactivar"><i class="fas fa-icons"></i></a>
    @else
        <a href="{{ route('productStatus', $id) }}" class="btn btn-danger" data-toggle="tooltip"
        data-placement="top" title="Activar"><i class="fas fa-icons"></i></a>
    @endif
@endcan
@can('product.destroy')
    <a class="btn btn-danger btn-sm" href="" data-target="#modal-delete-{{ $id }}" data-toggle="modal" title="Eliminar">
        <i class="fas fa-trash fa-fw"></i></a>
@endcan
@include('admin.product.delete', ['id' => $id])
