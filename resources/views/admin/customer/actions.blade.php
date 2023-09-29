@can('customer.index')
    <a href="{{ route('customer.edit', $id) }}" class="btn btn-warning btn-sm"
    data-toggle="tooltip" data-placement="top" title="Editar"><i class="far fa-edit"></i></a>
@endcan
@can('customer.show')
    <a href="{{ route('customer.show', $id) }}" class="btn btn-success btn-sm" data-toggle="tooltip"
    data-placement="top" title="Ver Cliente"><i class="far fa-eye"></i></a>
@endcan
@can('customer.destroy')
    <a class="btn btn-danger btn-sm" href="" data-target="#modal-delete-{{ $id }}"
    data-toggle="modal" title="Eliminar"><i class="fas fa-trash fa-1x"></i></a>
@endcan
@can('customer.customerStatus')
    @if ($status == 'active')
        <a href="{{ route('customerStatus', $id) }}" class="btn btn-verde btn-sm" data-toggle="tooltip"
        data-placement="top" title="Desactivar"><i class="fas fa-icons"></i></a>
    @else
        <a href="{{ route('customerStatus', $id) }}" class="btn btn-danger btn-sm" data-toggle="tooltip"
        data-placement="top" title="Activar"><i class="fas fa-icons"></i></a>
    @endif
@endcan
@include('admin.customer.delete', ['id' => $id])
