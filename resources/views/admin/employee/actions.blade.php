@can('employee.edit')
    <a href="{{ route('employee.edit', $id) }}" class="btn btn-warning btn-sm"
    data-toggle="tooltip" data-placement="top" title="Editar"><i class="far fa-edit"></i></a>
@endcan
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

