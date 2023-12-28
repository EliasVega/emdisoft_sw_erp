<div class="box-body row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="box-danger">
            <label class="form-control-label">
                <strong>Agregar Pago</strong>
            </label>
        </div>
    </div>
    <div class="col-lg-12 col-md-4 col-sm-4 col-xs-12" id="fpay">
        <div class="form-group">
            <label for="payment_form_id">F/Pago</label>
            <select name="payment_form_id" class="form-control selectpicker" id="payment_form_id"
                data-live-search="true">
                <option value="1" selected>contado.</option>
                @foreach($paymentForms as $paymentForm)
                <option value="{{ $paymentForm->id }}">{{ $paymentForm->name }}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="col-lg-6 col-md-4 col-sm-4 col-xs-12" id="methodPay">
        <div class="form-group">
            <label for="payment_method_id">Med/pago</label>
            <select name="payment_method_id" class="form-control selectpicker" id="payment_method_id"
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
            <label class="form-control-label" for="balance">Total Factura</label>
            <input type="number" id="balance" name="balance" value="0" class="form-control form-control-lg text-white bg-dark font-weight-bold" disabled pattern="[0-9]{0,15}">
        </div>
    </div>
    <div class="col-lg-12 col-md-6 col-sm-6 col-xs-12" id="pendadd">
        <div class="form-group">
            <label class="form-control-label">Pendiente</label>
            <input type="number" id="pendient" value="0" class="form-control" disabled pattern="[0-9]{0,15}">
        </div>
    </div>
    <div class="col-lg-12 col-md-6 col-sm-6 col-xs-12" id="valuePay">
        <div class="form-group">
            <label class="form-control-label requerido" for="pay">Abono</label>
            <input type="number" id="pay" name="pay" value="0"
                class="form-control form-control-lg text-white bg-info font-weight-bold" placeholder="pay" pattern="[0-9]{0,15}">
        </div>
    </div>
    <div class="col-lg-12 col-md-6 col-sm-6 col-xs-12" id="returnedBalance">
        <div class="form-group">
            <label class="form-control-label" for="returned">Cambio</label>
            <input type="number" id="returned" name="returned" value="0"
                class="form-control form-control-lg font-weight-bold text-white bg-primary" disabled pattern="[0-9]{0,15}">
        </div>
    </div>

    <div class="modal-footer" id="save">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="form-group">
                <input type="hidden" name="_token" value="{{csrf_token()}}">
                <button class="btn btn-lightBlueGrad" type="submit"><i class="fa fa-save"></i>&nbsp;
                    Registrar</button>
            </div>
        </div>
    </div>
</div>
