<a href="{{ route('ncpurchase.show', $id) }}" class="btn btn-success btn-sm" data-toggle="tooltip" data-placement="top"
    title="Ver Nota Credito"><i class="far fa-eye"></i>
</a>
<a href="{{ route('posPdfNcpurchase', $id) }}" class="btn btn-primary btn-sm" target="_blank" data-toggle="tooltip"
    data-placement="top" title="ticket"><i class="fas fa-receipt"></i>
</a>
<a href="{{ route('pdfNcpurchase', $id) }}" class="btn btn-pdf btn-sm" target="_blank" data-toggle="tooltip"
    data-placement="top" title="NCP pdf"><i class="fas fa-file-pdf"></i>
</a>
