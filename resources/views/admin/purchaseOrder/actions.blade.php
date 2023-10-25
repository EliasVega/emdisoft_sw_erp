@can('purchaseOrder.edit')
    <a href="{{ route('purchaseOrder.edit', $id) }}" class="btn btn-warning btn-sm" data-toggle="tooltip"
    data-placement="top" title="Editar"><i class="far fa-edit"></i></a>
@endcan
@can('purchaseOrder.show')
    <a href="{{ route('purchaseOrder.show', $id) }}" class="btn btn-success btn-sm" data-toggle="tooltip"
    data-placement="top" title="Ver Compra"><i class="far fa-eye"></i></a>
@endcan
<a href="{{ route('purchaseOrderPdf', $id) }}" class="btn btn-pdf btn-sm" target="_blank" data-toggle="tooltip" data-placement="top" title="Precompra pdf">
    <i class="fas fa-file-pdf"></i>
</a>
<a href="{{ route('purchaseOrderPos', $id) }}" class="btn btn-primary btn-sm" target="_blank" data-toggle="tooltip" data-placement="top" title="precompra pos" >
    <i class="fas fa-receipt"></i>
</a>
@if ($status == 'active')
    <a href="{{ route('purchaseOrderInvoice', $id) }}" class="btn btn-ver btn-sm" data-toggle="tooltip" data-placement="top" title="Facturar" >
        <i class="fas fa-receipt"></i>
    </a>
@endif


