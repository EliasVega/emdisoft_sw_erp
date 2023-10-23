
@if ($status == 'pending')
    <a href="{{ route('restaurantOrder.edit', $id) }}" class="btn btn-warning btn-sm" data-toggle="tooltip" data-placement="top" title="Editar">
        <i class="far fa-edit"></i>
    </a>
    <a href="{{ route('generateInvoice', $id) }}" class="btn btn-primary btn-sm" data-toggle="tooltip" data-placement="top" title="Facturar Comanda"><i class="fas fa-receipt"></i>
    </a>
@endif
<a href="{{ route('restaurantOrder.show', $id) }}" class="btn btn-success btn-sm" data-toggle="tooltip" data-placement="top" title="Ver Comanda" >
        <i class="far fa-eye"></i>
</a>
<a href="{{ route('restaurantOrderPos', $id) }}" class="btn btn-primary btn-sm" target="blanck" data-toggle="tooltip" data-placement="top" title="pos Comanda" >
    <i class="fas fa-receipt"></i>
</a>
@if ($status == 'pending')
    @can('restaurantOrder.destroy')
        <a class="btn btn-danger btn-sm" href="" data-target="#modal-delete-{{ $id }}" data-toggle="modal" title="Eliminar">
        <i class="fas fa-trash fa-fw"></i></a>
    @endcan
@endif

@include('admin.restaurantOrder.delete', ['id' => $id])

