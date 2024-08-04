
<a href="{{ route('cashRegister.edit', $id) }}" class="btn btn-sm btn-danger" data-toggle="tooltip"
data-placement="top" title="Cerrar Caja" ><i class="fas fa-user-lock"></i></a>

<a href="{{ route('cashRegister.show', $id) }}" class="btn btn-sm btn-success" data-toggle="tooltip"
data-placement="top" title="ver caja"><i class="fas fa-eye"></i></a>
<a href="{{ route('posCashRegister', $id) }}" class="btn btn-sm btn-primary" target="_blank" data-toggle="tooltip"
    data-placement="top" title="ticket caja"><i class="fas fa-newspaper"></i></a>
<a href="{{ route('cashRegisterClose', $id) }}" class="btn btn-sm btn-verde" data-toggle="tooltip" data-placement="top" title="Cierre de caja">
<i class="fas fa-newspaper"></i></a>


<a href="{{ route('show_cashInflow', $id) }}" class="btn btn-sm btn-dark" data-toggle="tooltip"
    data-placement="top" title="Recargar Caja"><i class="fas fa-dollar-sign"></i></a>
<a href="{{ route('show_cashOutflow', $id) }}" class="btn btn-sm btn-danger" data-toggle="tooltip"
data-placement="top" title="Salida Efectivo"><i class="fas fa-dollar-sign"></i></a>

<a href="{{ route('posCashRegister', $id) }}" class="btn btn-sm btn-primary" target="_blank" data-toggle="tooltip"
    data-placement="top" title="PosFpdf"><i class="fas fa-newspaper"></i></a>
