@can('product.edit')
    <a href="{{ route('product.edit', $id) }}" class="btn btn-warning" data-toggle="tooltip"
    data-placement="top" title="Editar"><i class="far fa-edit"></i></a>
@endcan
@can('kardex.kardexProduct')
    <a href="{{ route('kardexProduct', $id) }}" class="btn btn-limon" data-toggle="tooltip"
        data-placement="top" title="kardex"><i class="fas fa-undo-alt"> Kardex Producto</i></a>

@endcan
@can('product.destroy')
    <a class="btn btn-danger" href="" data-target="#modal-delete-{{ $id }}" data-toggle="modal" title="Eliminar">
        <i class="fas fa-trash fa-fw"></i></a>
@endcan
@include('admin.product.delete', ['id' => $id])
