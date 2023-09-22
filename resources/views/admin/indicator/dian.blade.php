@can('indicator.dianStatus')
    @if ($dian == 'on')
        <a href="{{ route('dianStatus', $id) }}" class="btn btn-success"
        data-toggle="tooltip" data-placement="top" title="Activa"><i class="far fa-edit"></i></a>
    @else
        <a href="{{ route('dianStatus', $id) }}" class="btn btn-danger" data-toggle="tooltip"
        data-placement="top" title="Inactiva"><i class="far fa-edit"></i></a>
    @endif
@endcan
