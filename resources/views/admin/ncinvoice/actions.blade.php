<a class="btn btn-primary btn-sm"
    href="{{ Storage::url('files/graphical_representations/ncinvoices/' . $document . '.pdf') }}"
    title="Representación grafica" target="_blank"><i class="fas fa-download fa-fw"></i> Pdf</a>

<a href="{{ route('posPdfNcinvoice', $id) }}" class="btn btn-primary btn-sm" target="_blank" data-toggle="tooltip"
    data-placement="top" title="ticket"><i class="fas fa-receipt"></i>pos</a>
    
<a href="{{ route('pdfNcinvoice', $id) }}" class="btn btn-pdf btn-sm" target="_blank" data-toggle="tooltip"
    data-placement="top" title="NC pdf"><i class="fas fa-file-pdf"></i></a>

<a href="{{ route('ncinvoice.show', $id) }}" class="btn btn-success btn-sm ml-3" data-toggle="tooltip"
    data-placement="top" title="Ver Nota Credito"><i class="far fa-eye"></i></a>
