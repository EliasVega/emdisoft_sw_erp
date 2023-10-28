@can('indicator.logoStatus')
    @if ($logo == 'on')
        <a href="{{ route('logoStatus', $id) }}" class="btn btn-success btn-sm"
        data-toggle="tooltip" data-placement="top" title="Activo"><i class="far fa-edit"></i></a>
    @else
        <a href="{{ route('logoStatus', $id) }}" class="btn btn-danger btn-sm" data-toggle="tooltip"
        data-placement="top" title="Inactivo"><i class="far fa-edit"></i></a>
    @endif
@endcan
