@if (Auth::user()->role_id != 4)

    <a href="{{ route('order.index', $id) }}" class="btn btn-lila btn-sm" data-toggle="tooltip"
    data-placement="top" title="Pedidos"><i class="far fa-file-alt"></i></a>
@endif





