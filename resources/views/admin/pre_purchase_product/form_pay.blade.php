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
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" id="addpayment">
        <div class="form-group">
            <button class="btn btn-celeste btn-sm" type="button" id="addpay" data-toggle="tooltip" data-placement="top" title="Desea Agregar Abono">Agregar abono </button>
        </div>
    </div>
    <div class="clearfix"></div>
    <div class="col-lg-4 col-md-3 col-sm-3 col-xs-12">
        <div class="form-group">
            <button class="btn btn-celeste btn-sm" type="button" id="noDefined" data-toggle="tooltip" data-placement="top" title="Metodo no definido">Indefinido </button>
        </div>
    </div>
    <div class="col-lg-4 col-md-3 col-sm-3 col-xs-12">
        <div class="form-group">
            <button class="btn btn-celeste btn-sm" type="button" id="cash" data-toggle="tooltip" data-placement="top" title="Efectivo">Efectivo</button>
        </div>
    </div>
    <div class="col-lg-4 col-md-3 col-sm-3 col-xs-12">
        <div class="form-group">
            <button class="btn btn-celeste btn-sm" type="button" id="advance" data-toggle="tooltip" data-placement="top" title="Anticipo">P/Anticipado</button>
        </div>
    </div>
    <div class="col-lg-4 col-md-3 col-sm-3 col-xs-12">
        <div class="form-group">
            <button class="btn btn-celeste btn-sm" type="button" id="transfer" data-toggle="tooltip" data-placement="top" title="Transferencia">Transferencia</button>
        </div>
    </div>
    <div class="col-lg-4 col-md-3 col-sm-3 col-xs-12">
        <div class="form-group">
            <button class="btn btn-celeste btn-sm" type="button" id="nequi" data-toggle="tooltip" data-placement="top" title="Nequi">Nequi</button>
        </div>
    </div>
    <div class="col-lg-4 col-md-3 col-sm-3 col-xs-12">
        <div class="form-group">
            <button class="btn btn-celeste btn-sm" type="button" id="card1" data-toggle="tooltip" data-placement="top" title="Tarjetas">T/Credito</button>
        </div>
    </div>
    <div class="col-lg-4 col-md-3 col-sm-3 col-xs-12">
        <div class="form-group">
            <button class="btn btn-celeste btn-sm" type="button" id="card2" data-toggle="tooltip" data-placement="top" title="Tarjetas">T/Debito</button>
        </div>
    </div>
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="box-danger">
            <label class="form-control-label">
                <strong>Agregar Abono</strong>
            </label>
        </div>
    </div>
    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
        <div class="form-group">
            <label class="form-control-label" for="balance">Total Factura</label>
            <input type="number" id="balance" name="balance" value="0" class="form-control gris" disabled pattern="[0-9]{0,15}">
        </div>
    </div>
    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
        <div class="form-group">
            <label class="form-control-label">Pendiente</label>
            <input type="number" id="pendient" value="0" class="form-control" disabled pattern="[0-9]{0,15}">
        </div>
    </div>
    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12" id="returnedBalance">
        <div class="form-group">
            <label class="form-control-label" for="returned">Saldo</label>
            <input type="number" id="returned" name="returned" value="0"
                class="form-control gris" disabled pattern="[0-9]{0,15}">
        </div>
    </div>

    <div class="col-lg-12 col-md-6 col-sm-6 col-xs-12" id="valuePay">
        <div class="form-group">
            <label class="form-control-label requerido" for="pay">Abono</label>
            <input type="number" id="pay" name="pay" value="0"
                class="form-control blanco" placeholder="pay" pattern="[0-9]{0,15}">
        </div>
    </div>
    <div class="col-lg-12 col-md-6 col-sm-6 col-xs-12" id="advancePay">
        <div class="form-group">
            <label class="form-control-label requerido" for="abpayment">abono anticipado</label>
            <input type="number" id="abpayment" name="abpayment"
                class="form-control blanco">
        </div>
    </div>
    <div class="col-lg-12 col-md-6 col-sm-6 col-xs-12" id="advancePayValue">
        <div class="form-group">
            <label class="form-control-label" for="payment">Abono +</label>
            <input type="number" id="payment" name="payment"
                class="form-control blanco" placeholder="valor" pattern="[0-9]{0,15}">
        </div>
    </div>
    <div class="col-lg-12 col-md-6 col-sm-6 col-xs-12" id="transactions">
        <div class="form-group">
            <label class="form-control-label" for="transaction">#Transaccion</label>
            <input type="text" id="transaction" name="transaction"
                class="form-control" placeholder="Operacion">
        </div>
    </div>

    <div class="col-lg-12 col-md-6 col-sm-6 col-xs-12" id="banks">
        <div class="form-group">
            <label class="requerido" for="bank_id">Bancos</label>
            <select name="bank_id" class="form-control selectpicker" id="bank_id"
                data-live-search="true">
                <option value="" disabled selected>Seleccionar...</option>
                @foreach($banks as $bank)
                <option value="{{ $bank->id }}">{{ $bank->name }}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="col-lg-12 col-md-6 col-sm-6 col-xs-12" id="cards">
        <div class="form-group">
            <label for="card_id">Tipo Tarjeta</label>
            <select name="card_id" class="form-control selectpicker" id="card_id"
                data-live-search="true">
                <option value="" disabled selected>seleccionar...</option>
                @foreach($cards as $card)
                <option value="{{ $card->id }}">{{ $card->name }}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" id="advancePayment">
        <div class="form-group">
            <label for="payment_id">Pago Anticipado</label>
            <select name="payment_id" class="form-control" id="payment_id">
                <option value ="0" disabled selected>Seleccionar...</option>
            </select>
        </div>
    </div>

    <div class="col-lg-2 col-md-3 col-sm-2 col-xs-12">
        <div class="form-group">
            <label class="form-control-label">Abonar</label><br>
            <button class="btn btn-grisb" type="button" id="paying" data-toggle="tooltip" data-placement="top" title="Abono"><i class="fas fa-check"></i> </button>
        </div>
    </div>
    <div class="col-lg-2 col-md-3 col-sm-2 col-xs-12">
        <div class="form-group">
            <label class="form-control-label" >Canc</label><br>
            <a href="{{url('purchase')}}" class="btn btn-grisb" data-toggle="tooltip" data-placement="top" title="Cancelar"><i class="fa fa-window-close"></i>&nbsp; </a>
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
                        <th>
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
                <button class="btn btn-celeste" type="submit"><i class="fa fa-save"></i>&nbsp;
                    Registrar</button>
            </div>
        </div>
    </div>
</div>
