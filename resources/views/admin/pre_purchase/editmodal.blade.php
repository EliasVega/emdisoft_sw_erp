<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Editando Pre compra</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                {!!Form::open(array('url'=>'prePurchase', 'method'=>'Post', 'autocomplete'=>'off'))!!}
                {!!Form::token()!!}
                    @include('admin/pre_purchase.form_modal')
                {!!Form::close()!!}
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-blueGrad" data-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-lightBlueGrad" id="updatePrePurchase">Guardar</button>
            </div>
        </div>
    </div>
</div>
