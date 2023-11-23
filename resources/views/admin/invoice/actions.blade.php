@can('invoice.edit')
    @if ($role == 'superAdmin')
        <a href="{{ route('invoice.edit', $id) }}" class="btn btn-warning btn-sm" data-toggle="tooltip"
        data-placement="top" title="Editar"><i class="far fa-edit"></i></a>
    @endif
@endcan
@can('invoice.show')
    <a href="{{ route('invoice.show', $id) }}" class="btn btn-success btn-sm" data-toggle="tooltip"
    data-placement="top" title="Ver Venta"><i class="far fa-eye"></i></a>
@endcan
@if ($balance > 0)
    <a href="{{ route('invoicePay', $id) }}" class="btn btn-ver btn-sm" data-toggle="tooltip" data-placement="top" title="Agregar Abono" >
        <i class="fas fa-file-invoice-dollar"></i>
    </a>
@endif
<a href="{{ route('invoicePos', $id) }}" class="btn btn-primary btn-sm" target="_blank" data-toggle="tooltip" data-placement="top" title="pdf pos" >
    <i class="fas fa-receipt"></i>
</a>
@if ($restaurant == 'off')
    <a href="{{ route('invoicePdf', $id) }}" class="btn btn-pdf btn-sm" target="_blank" data-toggle="tooltip" data-placement="top" title="Venta pdf">
        <i class="fas fa-file-pdf"></i>
    </a>
    @if ($status == 'invoice')
        <a href="{{ route('debitNoteInvoice', $id) }}" class="btn btn-lila btn-sm" data-toggle="tooltip"
        data-placement="top" title="Nota Debito" ><i class="fas fa-notes-medical"></i></a>
        <a href="{{ route('creditNoteInvoice', $id) }}" class="btn btn-limon btn-sm" data-toggle="tooltip"
        data-placement="top" title="Nota Credito" ><i class="fas fa-notes-medical"></i></a>
    @endif
    @if ($status == 'debit_note')
        <a href="{{ route('creditNoteInvoice', $id) }}" class="btn btn-limon btn-sm" data-toggle="tooltip"
        data-placement="top" title="Nota Credito" ><i class="fas fa-notes-medical"></i></a>
    @endif
    @if ($status == 'credit_note')
        <a href="{{ route('debitNoteInvoice', $id) }}" class="btn btn-lila btn-sm" data-toggle="tooltip"
        data-placement="top" title="Nota Debito" ><i class="fas fa-notes-medical"></i></a>
    @endif
@endif



