@can('purchase.index')
        <a href="{{ route('show_purchase', $id) }}" class="btn btn-primary btn-sm" data-toggle="tooltip"
        data-placement="top" title="Compras"><i class="fas fa-cart-plus"></i></a>
@endcan
@can('transfer.index')
    <a href="{{ route('transfer', $id) }}" class="btn btn-ver btn-sm" data-toggle="tooltip"
    data-placement="top" title="Traslados"><i class="fas fa-dumpster"></i></a>
@endcan

@if ($cashRegister == 'on')
    <a href="{{ route('show_cashRegister', $id) }}" class="btn btn-verde btn-sm" data-toggle="tooltip"
    data-placement="top" title="Caja"><i class="fas fa-cash-register"></i></a>
@endif








