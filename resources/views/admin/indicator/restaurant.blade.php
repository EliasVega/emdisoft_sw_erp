@can('indicator.restaurantStatus')
    @if ($restaurant == 'on')
        <a href="{{ route('restaurantStatus', $id) }}" class="btn btn-success btn-sm"
        data-toggle="tooltip" data-placement="top" title="Activa"><i class="far fa-edit"></i></a>
    @else
        <a href="{{ route('restaurantStatus', $id) }}" class="btn btn-danger btn-sm" data-toggle="tooltip"
        data-placement="top" title="Inactiva"><i class="far fa-edit"></i></a>
    @endif
@endcan
