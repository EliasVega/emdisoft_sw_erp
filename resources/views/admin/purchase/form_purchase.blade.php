<div class="box-body row">
    <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
        <div class="form-group">
            <label for="provider_id"> Proveedor <a href="{{ route('provider.create') }}" class="btn btn-lightBlueGrad btn-sm" target="_blank" data-toggle="tooltip" data-placement="top">
                <i class="fa fa-plus"> Agregar Proveedor</i>
            </a></label>
            <select name="provider_id" class="form-control selectpicker" id="provider_id"
                data-live-search="true" required>
                <option value="" disabled selected>Seleccionar el Proveedor</option>
                @foreach($providers as $provider)
                <option value="{{ $provider->id }}">{{ $provider->number }} - {{ $provider->name }}</option>
                @endforeach
            </select>
        </div>
    </div>
    @if ($countBranchs > 1)
        <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12 mt-2">
            <div class="form-group">
                <label class="form-control-label" for="branch_id">Sucursal Destino</label>
                    <select name="branch_id" class="form-control selectpicker" id="branch_id" data-live-search="true" required>
                        <option value="0" disabled selected>Seleccionar Sucursal</option>
                        @foreach($branchs as $branch)
                            <option value="{{ $branch->id }}">{{ $branch->name }}</option>
                        @endforeach
                    </select>
            </div>
        </div>
    @else
        <div class="col-lg-2 col-md-4 col-sm-4 col-xs-12" id="sucursalBis">
            <div class="form-group">
                <label class="form-control-label" for="branch_id">Sucursal</label>
                <input type="text" id="branch_id" name="branch_id" value="1" class="form-control" placeholder="Sucursal">
            </div>
        </div>
    @endif

    @if ($indicator->dian == 'on')
        <div class="col-lg-4 col-md-12 col-sm-12 col-xs-12">
            <div class="form-group">
                <label class="form-control-label" for="document_type_id">Tipo de Documento</label>
                    <select name="document_type_id" class="form-control selectpicker" id="document_type_id" data-live-search="true" required>
                        <option value="0" disabled selected>Seleccionar Tipo de documento</option>
                        @foreach($documentTypes as $documentType)
                            <option value="{{ $documentType->id }}">{{ $documentType->name }}</option>
                        @endforeach
                    </select>
            </div>
        </div>
    @else
        <div class="col-lg-2 col-md-4 col-sm-4 col-xs-12" id="documentBis">
            <div class="form-group">
                <label class="form-control-label" for="document_type_id">Typo Documento</label>
                <input type="text" id="document_type_id" name="document_type_id" value="25" class="form-control" placeholder="Tipo Documento">
            </div>
        </div>
    @endif

    <div class="col-lg-2 col-md-4 col-sm-4 col-xs-12" id="invoiceCode">
        <div class="form-group">
            <label class="form-control-label" for="invoice_code">N°Factura</label>
            <input type="text" id="invoice_code" name="invoice_code" value="{{ old('invoice_code') }}" class="form-control" placeholder="Numero de la factura" required>
        </div>
    </div>
    <div class="col-lg-2 col-md-4 col-sm-4 col-xs-12">
        <div class="form-group">
            <label class="form-control-label" for="generation_date">F/Generacion</label>
            <input type="date" name="generation_date" class="form-control" value="<?php echo date("Y-m-d");?>" placeholder="Fecha Vencimiento">
        </div>
    </div>
    <div class="col-lg-2 col-md-4 col-sm-4 col-xs-12">
        <div class="form-group">
            <label class="form-control-label" for="due_date">Vencimiento</label>
            <input type="date" name="due_date" class="form-control" value="<?php echo date("Y-m-d");?>" placeholder="Fecha Vencimiento">
        </div>
    </div>
    <div class="clearfix"></div>
    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12" id="resolution">
        <div class="form-group">
            <label class="form-control-label" for="resolution_id">Resolucion</label>
                <select name="resolution_id" class="form-control selectpicker" id="resolution_id" data-live-search="true">
                    <option value="1" disabled selected>Resolucion</option>
                    @foreach($resolutions as $resolution)
                        <option value="{{ $resolution->id }}">{{ $resolution->prefix }} {{ $resolution->resolution }}</option>
                    @endforeach
                </select>
        </div>
    </div>
    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12" id="generat">
        <div class="form-group">
            <label class="form-control-label" for="generation_type_id">Tipo de generacion</label>
                <select name="generation_type_id" class="form-control selectpicker" id="generation_type_id" data-live-search="true" required>
                    <option value="0" disabled selected>Tipo de generacion</option>
                    @foreach($generationTypes as $generationType)
                        <option value="{{ $generationType->id }}">{{ $generationType->description }}</option>
                    @endforeach
                </select>
        </div>
    </div>
    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12" id="startd">
        <div class="form-group">
            <label class="form-control-label" for="start_date">Fecha de inicio</label>
            <input type="date" name="start_date" id="start_date" class="form-control" value="<?php echo date("Y-m-d");?>">
        </div>
    </div>
    <div class="clearfix"></div>
    <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12" id="noteDocument">
        <div class="form-group">
            <label class="form-control-label" for="note">Observaciones</label>
            <input type="text" id="note" name="note" value="{{ old('note') }}" class="form-control" placeholder="Observaciones">
        </div>
    </div>
    <div class="col-lg-2 col-md-4 col-sm-4 col-xs-12">
        <div class="form-group">
            <label class="form-control-label" for="stock">Stock</label>
            <input type="number" id="stock" name="stock" value="{{ old('stock') }}" class="form-control"
                placeholder="stock" disabled pattern="[0-9]{0,15}">
        </div>
    </div>
    <div class="col-lg-2 col-md-4 col-sm-4 col-xs-12">
        <div class="form-group">
            <label class="form-control-label" for="tax_rate">Imp %</label>
            <input type="number" id="tax_rate" name="tax_rate" class="form-control" placeholder="%" disabled
                pattern="[0-9]{0,15}">
        </div>
    </div>
    <div class="col-lg-2 col-md-4 col-sm-4 col-xs-12">
        <div class="form-group">
            <label for="vprice">V/Actual</label>
            <input type="number" name="vprice" id="vprice"  class="form-control" readonly>
        </div>
    </div>
    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12" id="addTypeProduct">
        <div class="form-group">
            <label class="form-control-label" for="typeProduct">Typo Producto</label>
            <input type="number" id="typeProduct" name="typeProduct" class="form-control" value="{{ $typeProduct }}"
                pattern="[0-9]{0,15}">
        </div>
    </div>
    <div class="clearfix"></div>

    <div class="col-lg-4 col-md-12 col-sm-12 col-xs-12">
        <div class="form-group row">
            <label class="form-control-label" for="product_id">Producto</label>
                <select name="product_id" class="form-control selectpicker" id="product_id" data-live-search="true">
                    <option value="0" disabled selected>Seleccionar</option>
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
    <div class="col-lg-2 col-md-3 col-sm-4 col-xs-12">
        <div class="form-group">
            <label class="form-control-label" for="quantityadd">Cantidad</label>
            <input type="number" id="quantityadd" name="quantityadd"
                class="form-control" placeholder="Cant." pattern="[0-9]{0,15}">
        </div>
    </div>
    <div class="col-lg-2 col-md-3 col-sm-4 col-xs-12">
        <div class="form-group">
            <label class="form-control-label" for="price">Precio</label>
            <input type="number" id="price" name="price" class="form-control"
                placeholder="Precio">
        </div>
    </div>
    <div class="col-lg-2 col-md-3 col-sm-2 col-xs-12">
        <div class="form-group">
            <label class="form-control-label">Add</label><br>
            <button class="btn btn-lightBlueGrad" type="button" id="add" data-toggle="tooltip" data-placement="top" title="Add"><i class="fas fa-check"></i>&nbsp; </button>
        </div>
    </div>
    <div class="col-lg-2 col-md-3 col-sm-2 col-xs-12">
        <div class="form-group">
            <label class="form-control-label" >Canc</label><br>
            <a href="{{url('purchase')}}" class="btn btn-blueGrad" data-toggle="tooltip" data-placement="top" title="Cancelar"><i class="fa fa-window-close"></i>&nbsp; </a>
        </div>
    </div>

    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="table-responsive">
            <table id="details" class="table table-striped table-bordered table-condensed table-hover">
                <thead class="bg-info">
                    <tr>
                        <th>Eliminar</th>
                        <th>Editar</th>
                        <th>Id</th>
                        <th>Producto</th>
                        <th>Cantidad</th>
                        <th>precio ($)</th>
                        <th>imp (%)</th>
                        <th>SubTotal ($)</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th colspan="7" class="rightfoot">TOTAL:</th>
                        <td class="rightfoot thfoot"><strong id="total_html">$ 0.00</strong>
                            <input type="hidden" name="total" id="total"></td>
                    </tr>
                    <tr>
                        <th colspan="7" class="rightfoot">IMPUESTO:</th>
                        <td class="rightfoot thfoot"><strong id="total_tax_html">$ 0.00</strong>
                            <input type="hidden" name="total_tax" id="total_tax">
                        </td>
                    </tr>
                    <tr>
                        <th colspan="7" class="rightfoot">TOTAL COMPRA:</th>
                        <td class="rightfoot thfoot"><strong id="total_pay_html">$ 0.00</strong>
                            <input type="hidden" name="total_pay" id="total_pay"></td>
                    </tr>
                </tfoot>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>

</div>
