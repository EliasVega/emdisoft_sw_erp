<div class="box-body row">
    <div class="col-lg-6 col-md-4 col-sm-4 col-xs-12" id="fpay">
        <div class="form-group">
            <label for="payment_form_id">F/Pago</label>
            <select name="payment_form_id" class="form-control selectpicker" id="payment_form_id"
                data-live-search="true" required>
                <option value="" disabled selected>Seleccionar...</option>
                @foreach($paymentForms as $paymentForm)
                <option value="{{ $paymentForm->id }}">{{ $paymentForm->name }}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="col-lg-6 col-md-4 col-sm-4 col-xs-12" id="mpay">
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
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" id="editPayPayment">
        <div class="form-group">
            <button class="btn btn-lightBlueGrad btn-sm" type="button" id="payPays" data-toggle="tooltip" data-placement="top" title="Desea Agregar Abono">Agregar abono </button>
        </div>
    </div>

    <div class="col-lg-4 col-md-3 col-sm-3 col-xs-12" id="editPayCash">
        <div class="form-group">
            <button class="btn btn-lightBlueGrad btn-sm" type="button" id="cash" data-toggle="tooltip" data-placement="top" title="Efectivo">Efectivo</button>
        </div>
    </div>
    <div class="col-lg-4 col-md-3 col-sm-3 col-xs-12" id="payTransfer">
        <div class="form-group">
            <button class="btn btn-lightBlueGrad btn-sm" type="button" id="transfer" data-toggle="tooltip" data-placement="top" title="Transferencia">Transferencia</button>
        </div>
    </div>
    <div class="col-lg-4 col-md-3 col-sm-3 col-xs-12" id="payNequi">
        <div class="form-group">
            <button class="btn btn-lightBlueGrad btn-sm" type="button" id="nequi" data-toggle="tooltip" data-placement="top" title="Nequi">Nequi</button>
        </div>
    </div>
    <div class="col-lg-4 col-md-3 col-sm-3 col-xs-12" id="editPayCard1">
        <div class="form-group">
            <button class="btn btn-lightBlueGrad btn-sm" type="button" id="card1" data-toggle="tooltip" data-placement="top" title="Tarjetas">T/Credito</button>
        </div>
    </div>
    <div class="col-lg-4 col-md-3 col-sm-3 col-xs-12" id="editPayCard2">
        <div class="form-group">
            <button class="btn btn-lightBlueGrad btn-sm" type="button" id="card2" data-toggle="tooltip" data-placement="top" title="Tarjetas">T/Debito</button>
        </div>
    </div>
    <div class="col-lg-4 col-md-3 col-sm-3 col-xs-12" id="editPayUndefined">
        <div class="form-group">
            <button class="btn btn-lightBlueGrad btn-sm" type="button" id="noDefined" data-toggle="tooltip" data-placement="top" title="Metodo no definido">Indefinido </button>
        </div>
    </div>
    <div class="col-lg-4 col-md-3 col-sm-3 col-xs-12" id="editPayAdvance">
        <div class="form-group">
            <button class="btn btn-lightBlueGrad btn-sm" type="button" id="advance" data-toggle="tooltip" data-placement="top" title="Anticipo">Anticipo</button>
        </div>
    </div>
    <div class="col-lg-9 col-md-12 col-sm-12 col-xs-12">
        <div class="box-danger">
            <label class="form-control-label">
                <strong>Agregar Abono</strong>
            </label>
        </div>
    </div>
    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12" id="payBalance">
        <div class="form-group">
            <label class="form-control-label" for="balance">Total Factura</label>
            <input type="number" id="balance" name="balance" value="0" class="form-control blueGrad" disabled pattern="[0-9]{0,15}">
        </div>
    </div>
    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12" id="payBalanceOld">
        <div class="form-group">
            <label for="balance_old">Saldo Factura</label>
            <input type="text" name="balance_old" id="balance_old" value="{{ old('balance_old', $Invoice->balance ?? '') }}" class="form-control" placeholder="Codigo del product" readonly>
        </div>
    </div>
    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12" id="payPurchase">
        <div class="form-group">
            <label for="pay_Invoice">Pagos Factura</label>
            <input type="text" name="pay_Invoice" id="pay_Invoice" value="{{ old('pay_Invoice', $payPurchases ?? '') }}" class="form-control" placeholder="Codigo del product" readonly>
        </div>
    </div>
    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12" id="payReturned">
        <div class="form-group">
            <label class="form-control-label" for="returned">Saldo</label>
            <input type="number" id="returned" name="returned" value="0"
                class="form-control blueGrad" disabled pattern="[0-9]{0,15}">
        </div>
    </div>
    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12" id="payPay">
        <div class="form-group">
            <label class="form-control-label requerido" for="pay">Abono</label>
            <input type="number" id="pay" name="pay" value="0"
                class="form-control blanco" placeholder="pay" pattern="[0-9]{0,15}">
        </div>
    </div>

    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12" id="payPaymentAdvance">
        <div class="form-group">
            <label class="form-control-label requerido" for="abpayment">Anticipo</label>
            <input type="number" id="abpayment" name="abpayment"
                class="form-control blanco" placeholder="valor" pattern="[0-9]{0,15}">
        </div>
    </div>
    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12" id="payAdvance">
        <div class="form-group">
            <label class="form-control-label" for="advance">Abono +</label>
            <input type="number" id="advance" name="advance"
                class="form-control blanco" placeholder="valor" pattern="[0-9]{0,15}">
        </div>
    </div>
    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12" id="payTransaction">
        <div class="form-group">
            <label class="form-control-label" for="transaction">#Transaccion</label>
            <input type="text" id="transaction" name="transaction"
                class="form-control" placeholder="Operacion">
        </div>
    </div>

    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12" id="payBank">
        <div class="form-group">
            <label class="requerido" for="bank_id">Bancos</label>
            <select name="bank_id" class="form-control selectpicker" id="bank_id"
                data-live-search="true">
                <option value="" disabled selected>Seleccionar...</option>
                @foreach($banks as $ban)
                <option value="{{ $ban->id }}">{{ $ban->name }}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12" id="payCard">
        <div class="form-group">
            <label for="card_id">Tipo Tarjeta</label>
            <select name="card_id" class="form-control selectpicker" id="card_id"
                data-live-search="true">
                <option value="" disabled selected>seleccionar...</option>
                @foreach($cards as $car)
                <option value="{{ $car->id }}">{{ $car->name }}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12" id="payAdvanceId">
        <div class="form-group">
            <label for="advance_id">Pago Anticipado</label>
            <select name="advance_id" class="form-control" id="advance_id">
                <option value ="" disabled selected>Seleccionar...</option>
            </select>
        </div>
    </div>
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="table-responsive">
            <table id="payments" class="table table-striped table-bordered table-condensed table-hover">
                <thead class="bg-info">
                    <tr>
                        <th>Eliminar</th>
                        <th>Medio</th>
                        <th>T. card</th>
                        <th>Entidad</th>
                        <th>Transaccion</th>
                        <th>Valor</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th colspan="5">
                            <p align="right">TOTAL:</p>
                        </th>
                        <th class="thfoot">
                            <p align="right"><span id="totalpay_html">$ 0.00</span>
                                <input type="hidden" name="totalpay" id="totalpay"> </p>
                        </th>
                    </tr>
                </tfoot>
                <tbody>

                </tbody>
            </table>
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
