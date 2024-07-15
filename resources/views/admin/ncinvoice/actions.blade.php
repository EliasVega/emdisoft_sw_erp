@if ($dian == 'on')
    @if ($documentType == 1)
        <a class="btn btn-primary btn-sm" href="{{ Storage::url('files/graphical_representations/ncinvoices/'.$document.'.pdf') }}"
        title="Representación grafica" target="_blank"><i class="fas fa-download fa-fw"></i> Pdf</a>
    @elseif ($documentType == 15)
        <a href="{{ route('posPdfNcinvoice', $id) }}" class="btn btn-primary btn-sm" target="_blank" data-toggle="tooltip"
        data-placement="top" title="pdf pos" ><i class="fas fa-receipt"></i>pos</a>
    @endif
@else
    <a href="{{ route('ncinvoicePdf', $id) }}" class="btn btn-pdf btn-sm" target="_blank" data-toggle="tooltip" data-placement="top"
    title="nota credito pdf"><i class="fas fa-file-pdf"></i></a>

    <a href="{{ route('posPdfNcinvoice', $id) }}" class="btn btn-primary btn-sm" target="_blank" data-toggle="tooltip"
        data-placement="top" title="pdf pos" ><i class="fas fa-receipt"></i>pos</a>
@endif
    <a href="{{ route('ncinvoice.show', $id) }}" class="btn btn-success btn-sm ml-3" data-toggle="tooltip"
    data-placement="top" title="Ver Nota Credito"><i class="far fa-eye"></i></a>

