
@can('purchase.index')
    <a href="{{ route('purchase.index', $id) }}" class="btn btn-primary btn-sm" data-toggle="tooltip"
    data-placement="top" title="Compras"><i class="fas fa-cart-plus"></i></a>
@endcan
@if ($restaurant == 'off')
    @can('invoice.index')
        <a href="{{ route('invoice.index', $id) }}" class="btn btn-success btn-sm" data-toggle="tooltip"
        data-placement="top" title="Ventas"><i class="fas fa-file-export"></i></a>
    @endcan
@else
    @can('invoice.index')
        <a href="{{ route('restaurantOrder.index', $id) }}" class="btn btn-success btn-sm" data-toggle="tooltip"
        data-placement="top" title="Comandas"><i class="fas fa-file-export"></i></a>
    @endcan
@endif

@can('transfer.index')
    @if (Auth::user()->transfer == 1)
        <a href="{{ route('show_transfer', $id) }}" class="btn btn-ver btn-sm" data-toggle="tooltip"
        data-placement="top" title="Traslados"><i class="fas fa-dumpster"></i></a>
    @endif
@endcan
@if ($cashRegister == 'on')
    <a href="{{ route('cashRegister.index', $id) }}" class="btn btn-verde btn-sm" data-toggle="tooltip"
    data-placement="top" title="Caja"><i class="fas fa-cash-register"></i></a>
@endif








