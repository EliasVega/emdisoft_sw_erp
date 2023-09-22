@can('transfer.index')
    @if (Auth::user()->transfer == 1)
        <a href="{{ route('show_transfer', $id) }}" class="btn btn-ver btn-sm" data-toggle="tooltip"
        data-placement="top" title="Traslados"><i class="fas fa-dumpster"></i></a>
    @endif
@endcan





