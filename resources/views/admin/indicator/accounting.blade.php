@can('indicator.accountingStatus')
    @if ($accounting == 'on')
        <a href="{{ route('accountingStatus', $id) }}" class="btn btn-success" data-toggle="tooltip"
        data-placement="top" title="Activa"><i class="far fa-edit"></i></a>
    @else
        <a href="{{ route('accountingStatus', $id) }}" class="btn btn-danger" data-toggle="tooltip"
        data-placement="top" title="Inactiva"><i class="far fa-edit"></i></a>
    @endif
@endcan


