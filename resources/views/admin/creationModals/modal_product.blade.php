<!-- Modal -->
<div class="modal fade" id="prodModal" aria-labelledby="productModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" >
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="productModalLabel">Agregar Nuevo Producto</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form method="POST" id="productForm">
          @csrf                
          @if (indicator()->raw_material == 'off')
              <div class="row">
                  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    @include('admin/creationModals.form_modal_product')
                    @include('admin/generalview.form_register')
                  </div>
              </div>
            @else
              <div class="row">
                  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    @include('admin/creationModals.form_modal_product')
                    @include('admin/generalview.form_register')
                  </div>
              </div>
            @endif 
      </form> 
      </div>
    </div>
  </div>
</div>
