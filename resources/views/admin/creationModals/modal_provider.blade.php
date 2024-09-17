<div class="modal fade" id="providerModal" aria-labelledby="providerModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" >
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="providerModalLabel">Agregar Nuevo Proveedor</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form method="POST" id="providerForm">
            @csrf                
            @include('admin/creationModals.form_modal_provider')  
        </form> 
        </div>
      </div>
    </div>
  </div>