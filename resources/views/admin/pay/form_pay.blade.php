<div class="box-body row">
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
    <div class="clearfix"></div>

    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
        <div class="form-group">
            <button class="btn btn-lightBlueGrad btn-md" type="button" id="cash" data-toggle="tooltip" data-placement="top" title="Efectivo">Efectivo</button>
        </div>
    </div>
    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
        <div class="form-group">
            <button class="btn btn-lightBlueGrad btn-md" type="button" id="transfer" data-toggle="tooltip" data-placement="top" title="Transferencia">Transferencia</button>
        </div>
    </div>
    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
        <div class="form-group">
            <button class="btn btn-lightBlueGrad btn-md" type="button" id="nequi" data-toggle="tooltip" data-placement="top" title="Nequi">Nequi</button>
        </div>
    </div>
    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
        <div class="form-group">
            <button class="btn btn-lightBlueGrad btn-md" type="button" id="card1" data-toggle="tooltip" data-placement="top" title="Tarjetas">T/Credito</button>
        </div>
    </div>
    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
        <div class="form-group">
            <button class="btn btn-lightBlueGrad btn-md" type="button" id="card2" data-toggle="tooltip" data-placement="top" title="Tarjetas">T/Debito</button>
        </div>
    </div>
    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
        <div class="form-group">
            <button class="btn btn-lightBlueGrad btn-md" type="button" id="noDefined" data-toggle="tooltip" data-placement="top" title="Metodo no definido">Indefinido </button>
        </div>
    </div>
    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
        <div class="form-group">
            <button class="btn btn-lightBlueGrad btn-md" type="button" id="paymentThird" data-toggle="tooltip" data-placement="top" title="Anticipo">Anticipo</button>
        </div>
    </div>

    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="box-danger">
            <label class="form-control-label">
                <strong>Agregar Abono</strong>
            </label>
        </div>
    </div>
    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12" id="advanceId">
        <div class="form-group">
            <label for="advance_id">Anticipo</label>
            <select name="advance_id" class="form-control selectpicker" id="advance_id"
                data-live-search="true">
                <option value="" disabled selected>seleccionar...</option>
                @foreach($advances as $advance)
                <option value="{{ $advance->id }}_{{ $advance->balance }}">{{ $advance->advanceable->name }}-- {{ $advance->balance }}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12" id="advancey">
        <div class="form-group">
            <label class="form-control-label requerido" for="advance">Valor Anticipo</label>
            <input type="number" id="advance" name="advance"
                class="form-control blanco" placeholder="valor" pattern="[0-9]{0,15}" disabled>
        </div>
    </div>
    <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12" id="total_p">
        <div class="form-group">
            <label class="form-control-label" for="total_document">Valor Compra</label>
            <input type="number" id="total_document" name="total_document" value="{{ $document->total_pay }}" class="form-control blueGrad" disabled pattern="[0-9]{0,15}">
        </div>
    </div>
    <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12" id="balancy">
        <div class="form-group">
            <label class="form-control-label" for="balance">Saldo Pendiente</label>
            <input type="number" id="balance" name="balance" value="{{ $document->balance }}" class="form-control blueGrad" disabled pattern="[0-9]{0,15}">
        </div>
    </div>
    <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12" id="returny">
        <div class="form-group">
            <label class="form-control-label" for="returned">Menos este abono</label>
            <input type="number" id="returned" name="returned" value="0"
                class="form-control blueGrad" disabled pattern="[0-9]{0,15}">
        </div>
    </div>
    <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12" id="payi">
        <div class="form-group">
            <label class="form-control-label requerido" for="pay">Abono</label>
            <input type="number" id="pay" name="pay" value="{{ $document->balance }}"
                class="form-control blanco" placeholder="pay" pattern="[0-9]{0,15}">
        </div>
    </div>

    <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12" id="abpaymenty">
        <div class="form-group">
            <label class="form-control-label" for="payment">Abono +</label>
            <input type="number" id="payment" name="payment"
                class="form-control blanco" placeholder="valor" pattern="[0-9]{0,15}">
        </div>
    </div>
    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12" id="transactiony">
        <div class="form-group">
            <label class="form-control-label" for="transaction">#Transaccion</label>
            <input type="text" id="transaction" name="transaction"
                class="form-control" placeholder="Operacion">
        </div>
    </div>
    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12" id="banky">
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
    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12" id="cardy">
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

    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
        <div class="form-group">
            <button class="btn btn-lightBlueGrad" type="button" id="add"><i class="fa fa-save"></i>&nbsp; Agregar Abono</button>
            <a href="{{url('pay')}}" class="btn btn-blueGrad"><i class="fa fa-window-close"></i>&nbsp; Cancelar</a>
        </div>
    </div>

    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="table-responsive">
            <table id="details" class="table table-striped table-bordered table-condensed table-hover">
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
