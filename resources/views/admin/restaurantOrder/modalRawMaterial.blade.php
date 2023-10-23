<div class="modal fade" id="modalRawMaterial" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Editando</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                {!!Form::open(array('url'=>'restaurantOrder', 'method'=>'Post', 'autocomplete'=>'off'))!!}
                {!!Form::token()!!}
                    @include('admin/restaurantOrder.form_modalRawMaterial')
                {!!Form::close()!!}
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-lightBlueGrad" data-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-blueGrad" id="updateRawMaterial">Guardar</button>
            </div>
        </div>
    </div>
</div>
