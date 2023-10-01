@can('voucherType.edit')
    <a href="{{ route('voucherType.edit', $id) }}" class="btn btn-warning btn-sm" data-toggle="tooltip"
    data-placement="top" title="Editar"><i class="far fa-edit"></i></a>
@endcan
@can('voucherType.destroy')
    @if($status != 'locked')
        <a class="btn btn-danger btn-sm" href="" data-target="#modal-delete-{{ $id }}" data-toggle="modal" title="Eliminar">
            <i class="fas fa-trash fa-fw"></i>
        </a>
    @endif
@endcan
@include('admin.voucherType.delete', ['id' => $id])
