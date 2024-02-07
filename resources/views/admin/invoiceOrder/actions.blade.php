@if ($status == 'active')
        <a href="{{ route('invoiceOrder.edit', $id) }}" class="btn btn-warning btn-sm" data-toggle="tooltip"
        data-placement="top" title="Editar"><i class="far fa-edit"></i></a>

    <a href="{{ route('invoiceOrderInvoice', $id) }}" class="btn btn-lila btn-sm" data-toggle="tooltip" data-placement="top" title="Facturar Orden"><i class="fas fa-receipt"></i>
    </a>
@endif


    <a href="{{ route('invoiceOrder.show', $id) }}" class="btn btn-success btn-sm" data-toggle="tooltip"
    data-placement="top" title="Ver Venta"><i class="far fa-eye"></i></a>

@if ($pos == 'on')
    <a href="{{ route('invoiceOrderPos', $id) }}" class="btn btn-primary btn-sm" target="_blank" data-toggle="tooltip" data-placement="top" title="pdf pos" >
        <i class="fas fa-receipt"></i>
    </a>
@else
    <a href="{{ route('invoiceOrderPdf', $id) }}" class="btn btn-pdf btn-sm" target="_blank" data-toggle="tooltip" data-placement="top" title="Venta pdf">
        <i class="fas fa-file-pdf"></i>
    </a>
@endif



