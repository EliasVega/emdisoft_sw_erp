@can('purchase.edit')
    @if ($role == 'superAdmin')
        <a href="{{ route('purchase.edit', $id) }}" class="btn btn-warning" data-toggle="tooltip"
        data-placement="top" title="Editar"><i class="far fa-edit"></i></a>
    @endif
@endcan
@can('purchase.show')
    <a href="{{ route('purchase.show', $id) }}" class="btn btn-success" data-toggle="tooltip"
    data-placement="top" title="Ver Compra"><i class="far fa-eye"></i></a>
@endcan
@if ($balance > 0)
    <a href="{{ route('purchase_pay', $id) }}" class="btn btn-ver" data-toggle="tooltip" data-placement="top" title="Agregar Abono" >
        <i class="fas fa-file-invoice-dollar"></i>
    </a>
@endif
<a href="{{ route('purchasePdf', $id) }}" class="btn btn-pdf" target="_blank" data-toggle="tooltip" data-placement="top" title="Compra pdf">
    <i class="fas fa-file-pdf"></i>
</a>
<a href="{{ route('purchasePost', $id) }}" class="btn btn-primary" target="_blank" data-toggle="tooltip" data-placement="top" title="pdf Post" >
    <i class="fas fa-receipt"></i>
</a>
@if ($status == 'active')
    <a href="{{ route('creditNotePurchase', $id) }}" class="btn btn-limon" data-toggle="tooltip"
    data-placement="top" title="Nota Credito" ><i class="fas fa-notes-medical"></i></a>
    <a href="{{ route('debitNotePurchase', $id) }}" class="btn btn-lila" data-toggle="tooltip"
    data-placement="top" title="Nota debito" ><i class="fas fa-notes-medical"></i></a>
@endif


