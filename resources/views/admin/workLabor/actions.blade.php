<a href="{{ route('workLabor.show', $id) }}" class="btn btn-success btn-sm" data-toggle="tooltip"
    data-placement="top" title="Ver Venta"><i class="far fa-eye"></i></a>

    <a href="{{ route('workLaborPdf', $id) }}" class="btn btn-pdf btn-sm" target="_blank" data-toggle="tooltip" data-placement="top" title="Venta pdf">
        <i class="fas fa-file-pdf"></i>
    </a>
    <a href="{{ route('workLaborPos', $id) }}" class="btn btn-primary btn-sm" target="_blank"
    data-toggle="tooltip" data-placement="top" title="pdf pos" ><i class="fas fa-receipt"></i>
    </a>
