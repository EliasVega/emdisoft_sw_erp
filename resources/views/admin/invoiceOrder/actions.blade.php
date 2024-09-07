<a href="{{ route('invoiceOrder.edit', $id) }}" class="btn btn-warning btn-sm" data-toggle="tooltip" data-placement="top"
    title="Editar"><i class="far fa-edit"></i></a>

<a href="{{ route('invoiceOrderInvoice', $id) }}" class="btn btn-lila btn-sm" data-toggle="tooltip" data-placement="top"
    title="Facturar Orden"><i class="fas fa-receipt"></i></a>
    
<a href="{{ route('posPdfInvoiceOrder', $id) }}" class="btn btn-primary btn-sm" target="_blank" data-toggle="tooltip"
    data-placement="top" title="ticket"><i class="fas fa-receipt"></i></a>

<a href="{{ route('pdfInvoiceOrder', $id) }}" class="btn btn-pdf btn-sm" target="_blank" data-toggle="tooltip"
    data-placement="top" title="Venta pdf"><i class="fas fa-file-pdf"></i></a>

<a href="{{ route('invoiceOrder.show', $id) }}" class="btn btn-success btn-sm" data-toggle="tooltip"
    data-placement="top" title="Ver Venta"><i class="far fa-eye"></i></a>

<a href="{{ route('invoiceOrderDelete', $id) }}" class="btn btn-danger btn-sm" data-toggle="tooltip"
    data-placement="top" title="ELiminar"><i class="far fa-edit"></i></a>
