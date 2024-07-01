
@if ($status == 'pendient')
    <a href="{{ route('employeeInvoiceProduct.edit', $id) }}" class="btn btn-warning btn-sm" data-toggle="tooltip"
    data-placement="top" title="Editar"><i class="far fa-edit"></i></a>
@endif
@if (current_user()->id == 1)
    @if ($status == 'pendient')
        <a href="{{ route('empInvProStatus', $id) }}" class="btn btn-success btn-sm"
        data-toggle="tooltip" data-placement="top" title="Pendiente"><i class="far fa-edit"></i></a>
    @else
        @if ($status == 'canceled')
            <a href="{{ route('empInvProStatus', $id) }}" class="btn btn-danger btn-sm" data-toggle="tooltip"
            data-placement="top" title="Cancelado"><i class="far fa-edit"></i></a>
        @else
            <a href="{{ route('empInvProStatus', $id) }}" class="btn btn-primary btn-sm" data-toggle="tooltip"
            data-placement="top" title="N/credito"><i class="far fa-edit"></i></a>
        @endif
    @endif
@endif



