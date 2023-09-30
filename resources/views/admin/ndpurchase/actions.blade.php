@can('ndpurchase.show')
    <a href="{{ route('ndpurchase.show', $id) }}" class="btn btn-success btn-sm" data-toggle="tooltip"
    data-placement="top" title="Ver Nota Debito"><i class="far fa-eye"></i></a>
@endcan
<a href="{{ route('ndpurchasePdf', $id) }}" class="btn btn-pdf btn-sm" target="_blank" data-toggle="tooltip" data-placement="top" title="nota debito pdf">
    <i class="fas fa-file-pdf"></i>
</a>
