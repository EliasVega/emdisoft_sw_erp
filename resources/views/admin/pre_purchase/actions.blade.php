@can('prePurchase.edit')
    <a href="{{ route('prePurchase.edit', $id) }}" class="btn btn-warning" data-toggle="tooltip"
    data-placement="top" title="Editar"><i class="far fa-edit"></i></a>
@endcan
@can('prePurchase.show')
    <a href="{{ route('prePurchase.show', $id) }}" class="btn btn-success" data-toggle="tooltip"
    data-placement="top" title="Ver Compra"><i class="far fa-eye"></i></a>
@endcan
<a href="{{ route('prePurchasePdf', $id) }}" class="btn btn-pdf" target="_blank" data-toggle="tooltip" data-placement="top" title="Precompra pdf">
    <i class="fas fa-file-pdf"></i>
</a>
<a href="{{ route('prePurchasePost', $id) }}" class="btn btn-primary" target="_blank" data-toggle="tooltip" data-placement="top" title="precompra Post" >
    <i class="fas fa-receipt"></i>
</a>
@if ($status == 'active')
    <a href="{{ route('prePurchaseInvoice', $id) }}" class="btn btn-ver" data-toggle="tooltip" data-placement="top" title="Facturar" >
        <i class="fas fa-receipt"></i>
    </a>
@endif


