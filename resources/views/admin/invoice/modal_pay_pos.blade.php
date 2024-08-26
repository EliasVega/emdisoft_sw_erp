<div class="modal fade" id="payPos" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Pagando</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                    @include('admin/invoice.form_modal_paypos')
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-lightBlueGrad" data-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-blueGrad" id="savePayment">Agregar</button>
            </div>
        </div>
    </div>
</div>
