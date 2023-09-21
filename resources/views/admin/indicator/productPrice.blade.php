
@can('indicator.productPrice')
    @if ($product_price == 'automatic')
        <a href="{{ route('productPrice', $id) }}" class="btn btn-success"
        data-toggle="tooltip" data-placement="top" title="Automatico"><i class="far fa-edit"></i></a>
    @else
        <a href="{{ route('productPrice', $id) }}" class="btn btn-danger" data-toggle="tooltip"
        data-placement="top" title="Manual"><i class="far fa-edit"></i></a>
    @endif
@endcan
