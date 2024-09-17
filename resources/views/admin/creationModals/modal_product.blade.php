<div class="modal fade" id="productModal" aria-labelledby="productModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" >
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="productModalLabel">Agregar Nuevo Producto</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form method="POST" id="productForm">
            @csrf                
            @include('admin/creationModals.form_modal_product')  
        </form> 
        </div>
      </div>
    </div>
  </div>