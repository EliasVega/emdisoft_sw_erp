@can('pay.show')
    <a href="{{ route('pay.show', $id) }}" class="btn btn-success" data-toggle="tooltip"
    data-placement="top" title="Ver Abono" ><i class="far fa-eye"></i></a>
@endcan
<a href="{{ route('payPdf', $id) }}" class="btn btn-pdf" target="_blank" data-toggle="tooltip" data-placement="top" title="nota debito pdf">
    <i class="fas fa-file-pdf"></i></a>
