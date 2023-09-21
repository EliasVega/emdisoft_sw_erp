@can('indicator.inventoryStatus')
    @if ($inventory == 'on')
        <a href="{{ route('inventoryStatus', $id) }}" class="btn btn-success" data-toggle="tooltip"
        data-placement="top" title="Activo"><i class="far fa-edit"></i></a>
    @else
        <a href="{{ route('inventoryStatus', $id) }}" class="btn btn-danger" data-toggle="tooltip"
        data-placement="top" title="Inactivo"><i class="far fa-edit"></i></a>
    @endif
@endcan


