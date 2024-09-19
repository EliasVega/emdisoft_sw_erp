<!-- Modal -->
<div class="modal fade" id="customerModal" aria-labelledby="customerModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" >
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="customerModalLabel">Agregar Nuevo Cliente</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form method="POST" id="customerForm">
          @csrf                
          @include('admin/creationModals.form_modal_customer')  
      </form> 
      </div>
    </div>
  </div>
</div>