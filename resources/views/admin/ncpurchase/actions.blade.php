@can('ncpurchase.show')
    <a href="{{ route('ncpurchase.show', $id) }}" class="btn btn-success" data-toggle="tooltip"
    data-placement="top" title="Ver Nota Credito"><i class="far fa-eye"></i></a>
@endcan
<a href="{{ route('ncpurchasePdf', $id) }}" class="btn btn-pdf" target="_blank" data-toggle="tooltip"
data-placement="top" title="Nota credito pdf"><i class="fas fa-file-pdf"></i></a>
