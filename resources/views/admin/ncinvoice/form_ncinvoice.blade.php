<div class="box-body row">
    <div class="col-md-4" id="formRetentions">
        <div class="card card-primary card-outline">
            @include('admin/generalview.form_retention')
        </div>
    </div>
    <div class="col-md-4" id="formCard">
        <div class="card card-primary card-outline">
            <div class="row">
                
                
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                    <div class="form-group">
                        <label for="document">Venta #</label>
                        <input type="text" name="document" value="{{ $invoice->document }}"
                            class="form-control" placeholder="" readonly>
                    </div>
                </div>
                
                <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                    <div class="form-group">
                        <label for="">Cliente</label>
                        <input type="text" name="" value="{{ $invoice->third->name }}"
                            class="form-control" placeholder="" readonly>
                    </div>
                </div>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" id="addResolution">
                    <div class="form-group">
                        <label class="form-control-label" for="resolution_id">Resolucion</label>
                            <select name="resolution_id" class="form-control selectpicker" id="resolution_id" data-live-search="true">
                                <option value="3" disabled selected>Seleccionar...</option>
                                @foreach($resolutions as $resolution)
                                    <option value="{{ $resolution->id }}">{{ $resolution->prefix }} {{ $resolution->resolution }}</option>
                                @endforeach
                            </select>
                    </div>
                </div>
                <div class="col-lg-12 col-md-6 col-sm-12 col-xs-12" id="discrepancy">
                    <div class="form-group">
                        <label class="form-control-label" for="discrepancy_id">Motivo Nota Credito</label>
                            <select name="discrepancy_id" class="form-control selectpicker" id="discrepancy_id" data-live-search="true">
                                <option value="" disabled selected>Seleccionar...</option>
                                @foreach($discrepancies as $discrepancy)
                                    <option value="{{ $discrepancy->id }}">{{ $discrepancy->description }}</option>
                                @endforeach
                            </select>
                    </div>
                </div>
                
                <div class="col-lg-6 col-md-6 col-sm-8 col-xs-12 mt-3" id="addReverse" >
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
                
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" id="addproduct">
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
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12" id="addquantity">
                    <div class="form-group">
                        <label class="form-control-label" for="quantityadd">Cantidad</label>
                        <input type="number" id="quantityadd" name="quantityadd" class="form-control" placeholder="Cantidad"
                             pattern="[0-9]{0,15}">
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12" id="addprice">
                    <div class="form-group">
                        <label class="form-control-label" for="priceadd">Precio</label>
                        <input type="number" id="priceadd" name="priceadd" class="form-control" placeholder="Precio"
                             pattern="[0-9]{0,15}">
                    </div>
                </div>
                
                <div class="col-lg-2 col-md-2 col-sm-6 col-xs-12" id="added">
                    <div class="form-group">
                        <label class="form-control-label">Add</label><br>
                        <button class="btn btn-lightBlueGrad" type="button" id="add" data-toggle="tooltip" data-placement="top" title="adicionar"><i class="fas fa-check"></i>&nbsp; </button>
                    </div>
                </div>
                @include('admin/generalview.buttonRetention')
                @include('admin/generalview.form_register')
                
            </div>
        </div>
    </div>
    <div class="col-md-8">
        <div class="row">
            <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12" id="noteDocument">
                <div class="form-group">
                    <label class="form-control-label" for="note">Observaciones</label>
                    <input type="text" id="note" name="note" value="{{ old('note') }}"
                    class="form-control" placeholder="Observaciones">
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
                <div class="form-group">
                    <label class="form-control-label" for="generation_date">Generacion</label>
                    <input type="date" name="generation_date" id="generation_date" class="form-control"
                        value="<?php echo date('Y-m-d'); ?>" placeholder="Fecha Vencimiento">
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
                <div class="form-group">
                    <label class="form-control-label" for="due_date">Vencimiento</label>
                    <input type="date" name="due_date" id="due_date" class="form-control"
                    value="<?php echo date('Y-m-d'); ?>" placeholder="Fecha Vencimiento">
                </div>
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
                            <th>precio</th>
                            <th>Impto</th>
                            <th>%</th>
                            <th>SubTotal</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th  colspan="9"><p align="right">TOTAL:</p></th>
                            <th class="thfoot"><p align="right"><span id="total_html">$ 0.00</span>
                                <input type="hidden" name="total" id="total"> </p></th>
                        </tr>

                        <tr>
                            <th colspan="9"><p align="right">IMPUESTO:</p></th>
                            <th class="thfoot"><p align="right"><span id="total_tax_html">$ 0.00</span>
                                <input type="hidden" name="total_tax" id="total_tax"></p></th>
                        </tr>

                        <tr>
                            <th  colspan="9"><p align="right">TOTAL PAGAR:</p></th>
                            <th class="thfoot"><p align="right"><span align="right" id="total_pay_html">$ 0.00</span>
                                <input type="hidden" name="total_pay" id="total_pay"></p></th>
                        </tr>
                    </tfoot>
                    <tbody>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<div class="box-body row" id="doNotLook">
    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-12" id="idCustomer">
        <div class="form-group">
            <label for="customer_id">Id Cliente.</label>
            <input type="text" name="customer_id" value="{{ $invoice->third->id }}"
                class="form-control" placeholder="" readonly>
        </div>
    </div>
    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12" id="invoice">
        <div class="form-group">
            <label for="invoice_id">Venta id</label>
            <input type="number" name="invoice_id" value="{{ $invoice->id }}"
                class="form-control" placeholder="" readonly>
        </div>
    </div>
    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12" id="documentType">
        <div class="form-group">
            <label for="document_type_id">Tipo de Documento #</label>
            <input type="text" name="document_type_id" id="document_type_id" value="{{ $invoice->document_type_id }}"
                class="form-control" placeholder="" readonly>
        </div>
    </div>
    <div class="col-lg-6 col-md-6 col-sm-4 col-xs-12" id="addtax_rate">
        <div class="form-group">
            <label class="form-control-label" for="tax_rate">Tasa %</label>
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
    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12" id="addTypeProduct">
        <div class="form-group">
            <label class="form-control-label" for="typeProduct">Typo Producto</label>
            <input type="text" id="typeProduct" name="typeProduct" class="form-control" value="product">
        </div>
    </div>
    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12" id="addPriceWithTax">
        <div class="form-group">
            <label class="form-control-label" for="pwx">Precio con impuesto</label>
            <input type="text" id="pwx" name="pwx" class="form-control" value="{{ indicator()->price_with_tax }}">
        </div>
    </div>
</div>
