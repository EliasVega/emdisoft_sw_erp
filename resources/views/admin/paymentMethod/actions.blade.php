@can('paymentMethod.edit')
    <a href="{{ route('paymentMethod.edit', $id) }}" class="btn btn-warning" data-toggle="tooltip"
    data-placement="top" title="Editar"><i class="far fa-edit"></i></a>
@endcan
@can('paymentMethod.paymentMethodStatus')
    @if ($status == 'active')
        <a href="{{ route('paymentMethodStatus', $id) }}" class="btn btn-verde" data-toggle="tooltip"
        data-placement="top" title="Desactivar"><i class="fas fa-icons"></i></a>
    @else
        <a href="{{ route('paymentMethodStatus', $id) }}" class="btn btn-danger" data-toggle="tooltip"
        data-placement="top" title="Activar"><i class="fas fa-icons"></i></a>
    @endif
@endcan
@can('paymentMethod.destroy')
    <a class="btn btn-danger" href="" data-target="#modal-delete-{{ $id }}" data-toggle="modal" title="Eliminar">
        <i class="fas fa-trash fa-fw"></i></a>
@endcan
@include('admin.paymentMethod.delete', ['id' => $id])
