<div class="box-body row">
    <div class="col-lg-6 col-md-6 col-sm-8 col-xs-12 mt-3" id="addReverse" >
        <span><strong>dinero sobrante</strong></span><br>
        <div class="form-check">
            <input class="form-check-input" type="radio" name="reverse" value="1" id="reverse_on">
            <label class="form-check-label" for="reverse">
                Regresar Valor de la Caja
            </label>
            </div>
            <div class="form-check">
            <input class="form-check-input" type="radio" name="reverse" value="2" id="reverse_off" checked>
            <label class="form-check-label" for="reverse">
                Dejar valor como anticipo
            </label>
        </div>
    </div>
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" id="addRemissionPayments">
        <div class="form-group">
            <label class="form-control-label" for="remission_payments">Abonos</label>
            <input type="text" id="remission_payments" name="remission_payments" value="{{ $remission->pay }}" class="form-control"
                placeholder="Observaciones">
        </div>
    </div>
</div>
