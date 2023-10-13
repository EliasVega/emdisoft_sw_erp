@can('ncinvoice.show')
    <a href="{{ route('ncinvoice.show', $id) }}" class="btn btn-success btn-sm" data-toggle="tooltip"
    data-placement="top" title="Ver Nota Credito"><i class="far fa-eye"></i></a>
@endcan
<a href="{{ route('ncinvoicePdf', $id) }}" class="btn btn-pdf btn-sm" target="_blank" data-toggle="tooltip" data-placement="top" title="nota credito pdf">
    <i class="fas fa-file-pdf"></i>
</a>
