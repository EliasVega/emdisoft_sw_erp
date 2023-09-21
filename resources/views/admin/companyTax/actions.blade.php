@can('companyTax.edit')
    <a href="{{ route('companyTax.edit', $id) }}" class="btn btn-warning" data-toggle="tooltip"
    data-placement="top" title="Editar"><i class="far fa-edit"></i></a>
@endcan
@can('companyTax.destroy')
    <a class="btn btn-danger" href="" data-target="#modal-delete-{{ $id }}" data-toggle="modal" title="Eliminar">
        <i class="fas fa-trash fa-fw"></i></a>
@endcan
@include('admin.companyTax.delete', ['id' => $id])
