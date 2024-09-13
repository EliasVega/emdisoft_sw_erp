@can('expense.edit')
    @if ($role == 'superAdmin')
        <a href="{{ route('expense.edit', $id) }}" class="btn btn-warning btn-sm" data-toggle="tooltip"
        data-placement="top" title="Editar"><i class="far fa-edit"></i></a>
    @endif
@endcan
    <a href="{{ route('expense.show', $id) }}" class="btn btn-success btn-sm" data-toggle="tooltip"
    data-placement="top" title="Ver Compra"><i class="far fa-eye"></i>
</a>

@if ($balance > 0)
    <a href="{{ route('expensePay', $id) }}" class="btn btn-ver btn-sm" data-toggle="tooltip" data-placement="top" title="Agregar Abono" >
        <i class="fas fa-file-invoice-dollar"></i>
    </a>
@endif
<a href="{{ route('posPdfExpense', $id) }}" class="btn btn-primary btn-sm" target="_blank" data-toggle="tooltip"
    data-placement="top" title="ticket" ><i class="fas fa-receipt"></i>
</a>
<a href="{{ route('pdfExpense', $id) }}" class="btn btn-pdf btn-sm" target="_blank" data-toggle="tooltip"
    data-placement="top" title="Venta pdf"><i class="fas fa-file-pdf"></i>
</a>



