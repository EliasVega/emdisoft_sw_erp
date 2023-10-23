@can('purchase.show')
    <a href="{{ route('purchase.show', $id) }}" class="btn btn-success btn-sm" data-toggle="tooltip"
    data-placement="top" title="Ver Compra"><i class="far fa-eye"></i></a>
@endcan
@if ($balance > 0)
    <a href="{{ route('purchase_pay', $id) }}" class="btn btn-ver btn-sm" data-toggle="tooltip" data-placement="top" title="Agregar Abono" >
        <i class="fas fa-file-invoice-dollar"></i>
    </a>
@endif
<a href="{{ route('purchasePdf', $id) }}" class="btn btn-pdf btn-sm" target="_blank" data-toggle="tooltip" data-placement="top" title="Compra pdf">
    <i class="fas fa-file-pdf"></i>
</a>
<a href="{{ route('purchasePos', $id) }}" class="btn btn-primary btn-sm" target="_blank" data-toggle="tooltip" data-placement="top" title="pdf pos" >
    <i class="fas fa-receipt"></i>
</a>
@if ($status == 'purchase')
    <a href="{{ route('creditNotePurchase', $id) }}" class="btn btn-limon btn-sm" data-toggle="tooltip"
    data-placement="top" title="Nota Credito" ><i class="fas fa-notes-medical"></i></a>
    <a href="{{ route('debitNotePurchase', $id) }}" class="btn btn-lila btn-sm" data-toggle="tooltip"
    data-placement="top" title="Nota debito" ><i class="fas fa-notes-medical"></i></a>
@endif
@if ($status == 'support_document')
    <a href="{{ route('debitNotePurchase', $id) }}" class="btn btn-lila btn-sm" data-toggle="tooltip"
    data-placement="top" title="Nota de ajusteo" ><i class="fas fa-notes-medical"></i></a>
@endif
@if ($status == 'credit_note')
    <a href="{{ route('debitNotePurchase', $id) }}" class="btn btn-lila btn-sm" data-toggle="tooltip"
    data-placement="top" title="Nota debito" ><i class="fas fa-notes-medical"></i></a>
@endif
@if ($status == 'debit_note')
    <a href="{{ route('creditNotePurchase', $id) }}" class="btn btn-limon btn-sm" data-toggle="tooltip"
    data-placement="top" title="Nota Credito" ><i class="fas fa-notes-medical"></i></a>
@endif



