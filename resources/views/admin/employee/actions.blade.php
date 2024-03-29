@can('employee.edit')
    <a href="{{ route('employee.edit', $id) }}" class="btn btn-warning btn-sm"
    data-toggle="tooltip" data-placement="top" title="Editar"><i class="far fa-edit"></i></a>
@endcan
<a href="{{ route('paymentCommission', $id) }}" class="btn btn-primary btn-sm" data-toggle="tooltip"
data-placement="top" title="pago comisiones"><i class="fas fa-file-invoice-dollar"></i></a>
@can('employee.show')
    <a href="{{ route('employee.show', $id) }}" class="btn btn-success btn-sm" data-toggle="tooltip"
    data-placement="top" title="Ver Empleado"><i class="far fa-eye"></i></a>
@endcan
@can('employee.employeeStatus')
    @if ($status == 'active')
        <a href="{{ route('employeeStatus', $id) }}" class="btn btn-verde btn-sm" data-toggle="tooltip"
        data-placement="top" title="Desactivar"><i class="fas fa-icons"></i></a>
    @else
        <a href="{{ route('employeeStatus', $id) }}" class="btn btn-danger btn-sm" data-toggle="tooltip"
        data-placement="top" title="Activar"><i class="fas fa-icons"></i></a>
    @endif
@endcan
@can('superAdmin')
    <a class="btn btn-danger btn-sm" href="" data-target="#modal-delete-{{ $id }}" data-toggle="modal" title="Eliminar">
    <i class="fas fa-trash fa-fw"></i></a>
@endcan
@include('admin.employee.delete', ['id' => $id])

