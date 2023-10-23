
@can('indicator.posStatus')
    @if ($pos == 'on')
        <a href="{{ route('posStatus', $id) }}" class="btn btn-success btn-sm"
        data-toggle="tooltip" data-placement="top" title="Activa"><i class="far fa-edit"></i></a>
    @else
        <a href="{{ route('posStatus', $id) }}" class="btn btn-danger btn-sm" data-toggle="tooltip"
        data-placement="top" title="Inactiva"><i class="far fa-edit"></i></a>
    @endif
@endcan
