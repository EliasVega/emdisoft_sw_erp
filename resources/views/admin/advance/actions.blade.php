@can('advance.show')
    <a href="{{ route('advance.show', $id) }}">
        <button class="btn btn-success" data-toggle="tooltip" data-placement="top" title="Ver Abono" ><i class="far fa-eye"></i></button>
    </a>
@endcan
<a href="{{ route('advancePdf', $id) }}" class="btn btn-pdf" target="_blank" data-toggle="tooltip" data-placement="top" title="PDF">
    <i class="fas fa-file-pdf"></i>
</a>
