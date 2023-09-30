<div class="box-body row">
    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-12" id="idProvider">
        <div class="form-group">
            <label for="provider_id">Id_Sup.</label>
            <input type="text" name="provider_id" value="{{ $purchase->third->id }}"
                class="form-control" placeholder="" readonly>
        </div>
    </div>
    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
        <div class="form-group">
            <label for="purchase_id">Compra</label>
            <input type="text" name="purchase_id" value="{{ $purchase->id }}"
                class="form-control" placeholder="" readonly>
        </div>
    </div>
    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
        <div class="form-group">
            <label for="">Proveedor</label>
            <input type="text" name="" value="{{ $purchase->third->name }}"
                class="form-control" placeholder="" readonly>
        </div>
    </div>
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" id="discrepancy">
        <div class="form-group">
            <label class="form-control-label" for="discrepancy_id">Motivo Nota Credito</label>
                <select name="discrepancy_id" class="form-control selectpicker" id="discrepancy_id" data-live-search="true">
                    <option value="0" disabled selected>Seleccionar...</option>
                    @foreach($discrepancies as $discrepancy)
                        <option value="{{ $discrepancy->id }}">{{ $discrepancy->description }}</option>
                    @endforeach
                </select>
        </div>
    </div>
    <div class="col-lg-10 col-md-10 col-sm-8 col-xs-12" id="addResolution">
        <div class="form-group">
            <label class="form-control-label" for="resolution_id">Resolucion</label>
                <select name="resolution_id" class="form-control selectpicker" id="resolution_id" data-live-search="true">
                    <option value="2" disabled selected>Seleccionar...</option>
                    @foreach($resolutions as $resolution)
                        <option value="{{ $resolution->id }}">{{ $resolution->prefix }}</option>
                    @endforeach
                </select>
        </div>
    </div>
    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12" id="addiva">
        <div class="form-group">
            <label class="form-control-label" for="tax_rate">Tasa iva</label>
            <input type="number" id="tax_rate" name="tax_rate" class="form-control" placeholder="Iva"
                disabled pattern="[0-9]{0,15}">
        </div>
    </div>

    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12" id="addstock">
        <div class="form-group">
            <label class="form-control-label" for="stock">Stock</label>
            <input type="number" id="stock" name="stock" class="form-control" placeholder="Stock"
                disabled pattern="[0-9]{0,15}">
        </div>
    </div>

    <div class="col-lg-4 col-md-12 col-sm-12 col-xs-12" id="addproduct">
        <div class="form-group row">
            <label class="form-control-label" for="product_id">Producto</label>
                <select name="product_id" class="form-control selectpicker" id="product_id" data-live-search="true">
                    <option value="" disabled selected>Seleccionar</option>
                    @foreach($products as $product)
                        <option value="{{ $product->id }}_{{ $product->stock }}_{{ $product->price }}_{{ $product->category->companyTax->percentage->percentage }}_{{ $product->category->companyTax->taxType->id }}">{{ $product->name }}</option>
                    @endforeach
                </select>
        </div>
    </div>
    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12" id="taxType">
        <div class="form-group">
            <label class="form-control-label" for="tax_type">Iva</label>
            <input type="number" id="tax_type" name="tax_type" class="form-control" value="0" disabled
                pattern="[0-9]{0,15}">
        </div>
    </div>
    <div class="col-lg-2 col-md-4 col-sm-6 col-xs-12" id="addquantity">
        <div class="form-group">
            <label class="form-control-label" for="vquantity">Cantidad</label>
            <input type="number" id="vquantity" name="vquantity" class="form-control" placeholder="Cantidad">
        </div>
    </div>
    <div class="col-lg-2 col-md-4 col-sm-6 col-xs-12" id="addprice">
        <div class="form-group">
            <label class="form-control-label" for="price">Precio</label>
            <input type="number" id="price" name="price" class="form-control" placeholder="Precio"
                 pattern="[0-9]{0,15}">
        </div>
    </div>
    <div class="col-lg-2 col-md-2 col-sm-6 col-xs-12" id="added">
        <div class="form-group">
            <label class="form-control-label">Add</label><br>
            <button class="btn btn-blueGrad" type="button" id="add" data-toggle="tooltip" data-placement="top" title="adicionar"><i class="fas fa-check"></i>&nbsp; </button>
        </div>
    </div>
    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-12" id="cancelled">
        <div class="form-group">
            <label class="form-control-label" >Canc</label><br>
            <a href="{{url('purchase')}}" class="btn btn-blueGrad" data-toggle="tooltip" data-placement="top" title="Cancelar"><i class="fa fa-window-close"></i></a>
        </div>
    </div>

        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="table-responsive">
                <table id="details" class="table table-striped table-bordered table-condensed table-hover" >
                    <thead class="bg-info">
                        <tr>

                            <th>Eliminar</th>
                            <th>Editar</th>
                            <th>Id Imp</th>
                            <th>ID</th>
                            <th>Producto</th>
                            <th>Cantidad</th>
                            <th>precio ($)</th>
                            <th>Imp. %</th>
                            <th>SubTotal ($)</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th  colspan="8"><p align="right">TOTAL:</p></th>
                            <th class="thfoot"><p align="right"><span id="total_html">$ 0.00</span>
                                <input type="hidden" name="total" id="total"> </p></th>
                        </tr>

                        <tr>
                            <th colspan="8"><p align="right">IMPUESTO:</p></th>
                            <th class="thfoot"><p align="right"><span id="total_tax_html">$ 0.00</span>
                                <input type="hidden" name="total_tax" id="total_tax"></p></th>
                        </tr>

                        <tr>
                            <th  colspan="8"><p align="right">TOTAL PAGAR:</p></th>
                            <th class="thfoot"><p align="right"><span align="right" id="total_pay_html">$ 0.00</span>
                                <input type="hidden" name="total_pay" id="total_pay"></p></th>
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
                <button class="btn btn-lightBlueGrad" type="submit"><i class="fa fa-save fa-2x"></i>&nbsp; Registrar</button>
            </div>
        </div>
    </div>
</div>
