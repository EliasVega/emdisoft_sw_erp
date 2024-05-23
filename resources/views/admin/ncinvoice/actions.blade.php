@if ($dian == 'on')
    <a class="btn btn-primary btn-sm" href="{{ Storage::url('files/graphical_representations/ncinvoice/'.$document.'.pdf') }}" title="Representación grafica" target="_blank">
        <i class="fas fa-download fa-fw"></i> Pdf
@else
    <a href="{{ route('ncinvoicePdf', $id) }}" class="btn btn-pdf btn-sm" target="_blank" data-toggle="tooltip" data-placement="top" title="nota credito pdf">
        <i class="fas fa-file-pdf"></i>
    </a>
@endif
@can('ncinvoice.show')
    <a href="{{ route('ncinvoice.show', $id) }}" class="btn btn-success btn-sm ml-3" data-toggle="tooltip"
    data-placement="top" title="Ver Nota Credito"><i class="far fa-eye"></i></a>
@endcan

