<div class="box-body row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="box-danger">
            <label class="form-control-label">
                <strong>Agregar Pago</strong>
            </label>
        </div>
    </div>
    <div class="col-lg-12 col-md-4 col-sm-4 col-xs-12" id="fpayModal">
        <div class="form-group">
            <label for="payment_form_modal">F/Pago</label>
            <select name="payment_form_modal" class="form-control selectpicker" id="payment_form_modal"
                data-live-search="true" required>
                <option value="" selected>seleccionar....</option>
                @foreach($paymentForms as $paymentForm)
                <option value="{{ $paymentForm->id }}">{{ $paymentForm->name }}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="col-lg-6 col-md-4 col-sm-4 col-xs-12" id="methodPayModal">
        <div class="form-group">
            <label for="payment_method_modal">Med/pago</label>
            <select name="payment_method_modal" class="form-control selectpicker" id="payment_method_modal"
                data-live-search="true">
                <option value="" disabled selected>Seleccionar...</option>
                @foreach($paymentMethods as $paymentMethod)
                <option value="{{ $paymentMethod->id }}">{{ $paymentMethod->name }}</option>
                @endforeach
            </select>
        </div>
    </div>
</div>
<div class="box-body row">
    <div class="col-lg-12 col-md-6 col-sm-6 col-xs-12">
        <div class="form-group">
            <label class="form-control-label" for="balanceModal">Total Factura</label>
            <input type="number" id="balanceModal" name="balanceModal" value="0" class="form-control form-control-lg text-white bg-dark font-weight-bold" disabled pattern="[0-9]{0,15}">
        </div>
    </div>
    <div class="col-lg-12 col-md-6 col-sm-6 col-xs-12" id="pendaddModal">
        <div class="form-group">
            <label class="form-control-label">Pendiente</label>
            <input type="number" id="pendientModal" value="0" class="form-control" disabled pattern="[0-9]{0,15}">
        </div>
    </div>
    <div class="col-lg-12 col-md-6 col-sm-6 col-xs-12" id="valuePayModal">
        <div class="form-group">
            <label class="form-control-label requerido" for="payModal">Pago</label>
            <input type="number" id="payModal" name="payModal" value="0"
                class="form-control form-control-lg text-white bg-info font-weight-bold" placeholder="pay" pattern="[0-9]{0,15}" required>
        </div>
    </div>
    <div class="col-lg-12 col-md-6 col-sm-6 col-xs-12" id="returnedBalanceModal">
        <div class="form-group">
            <label class="form-control-label" for="returnedModal">Cambio</label>
            <input type="number" id="returnedModal" name="returnedModal" value="0"
                class="form-control form-control-lg font-weight-bold text-white bg-primary" disabled pattern="[0-9]{0,15}">
        </div>
    </div>
</div>
