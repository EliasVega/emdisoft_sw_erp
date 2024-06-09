<a href="{{ route('remissionPos', $id) }}" class="btn btn-primary btn-sm" target="_blank" data-toggle="tooltip" data-placement="top" title="pdf pos" >
    <i class="fas fa-receipt"></i>
</a>
<a href="{{ route('remissionPdf', $id) }}" class="btn btn-pdf btn-sm" target="_blank" data-toggle="tooltip" data-placement="top" title="Venta pdf">
    <i class="fas fa-file-pdf"></i>
</a>
<a href="{{ route('remission.edit', $id) }}" class="btn btn-warning btn-sm" data-toggle="tooltip"
data-placement="top" title="Editar"><i class="far fa-edit"></i></a>
<a href="{{ route('remission.show', $id) }}" class="btn btn-success btn-sm" data-toggle="tooltip"
data-placement="top" title="Ver Venta"><i class="far fa-eye"></i></a>

@if ($balance > 0)
    <a href="{{ route('remissionPay', $id) }}" class="btn btn-ver btn-sm" data-toggle="tooltip" data-placement="top" title="Agregar Abono" >
        <i class="fas fa-file-invoice-dollar"></i>
    </a>
@endif



