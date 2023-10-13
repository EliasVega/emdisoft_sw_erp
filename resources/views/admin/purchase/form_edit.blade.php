<div class="box-body row">
    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
        <label for="provider_id">Proveedor</label>
        <div class="select">
            <select id="provider_id" name="provider_id" class="form-control selectpicker" data-live-search="true" required>
                <option {{ old('provider_id', $purchase->provider_id ?? '') == '' ? "selected" : "" }} disabled>Seleccionar Proveedor</option>
                @foreach($providers as $provider)
                    @if(old('provider_id', $purchase->provider_id ?? '') == $provider->id)
                        <option value="{{ $provider->id }}" selected>{{ $provider->name }}</option>
                    @else
                        <option value="{{ $provider->id }}">{{ $provider->name }}</option>
                    @endif
                @endforeach
            </select>
        </div>
    </div>
    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
        <label for="branch_id">Sucursal de Destino</label>
        <div class="select">
            <select id="branch_id" name="branch_id" class="form-control selectpicker" data-live-search="true" disabled>
                <option {{ old('branch_id', $purchase->branch_id ?? '') == '' ? "selected" : "" }} disabled>Seleccionar tipo de persona</option>
                @foreach($branchs as $branch)
                    @if(old('branch_id', $purchase->branch_id ?? '') == $branch->id)
                        <option value="{{ $branch->id }}" selected>{{ $branch->name }}</option>
                    @else
                        <option value="{{ $branch->id }}">{{ $branch->name }}</option>
                    @endif
                @endforeach
            </select>
        </div>
    </div>

    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12" id="editDocument">
        <div class="form-group">
            <label class="form-control-label" for="document">N°Factura</label>
            <input type="text" id="document" name="document" value="{{ $purchase->document }}" class="form-control" placeholder="Numero de la factura" required readonly>
        </div>
    </div>
    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
        <div class="form-group">
            <label class="form-control-label" for="generation_date">Fecha Generacion</label>
            <input type="date" name="generation_date" value="{{ $purchase->generation_date }}" class="form-control" placeholder="Fecha Vencimiento">
        </div>
    </div>
    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12" id="editDueDate">
        <div class="form-group">
            <label class="form-control-label" for="due_date">Vencimiento</label>
            <input type="date" name="due_date" value="{{ $purchase->due_date }}" class="form-control" placeholder="Fecha Vencimiento">
        </div>
    </div>
    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12" id="editRadio">
        <div class="form-check">
            <input class="form-check-input" type="radio" name="percentage" value="1" id="rtfon">
            <label class="form-check-label" for="retefte">
                Retenciones
            </label>
            </div>
            <div class="form-check">
            <input class="form-check-input" type="radio" name="percentage" value="0" id="rtfoff" checked>
            <label class="form-check-label" for="retefte">
                No Retenciones
            </label>
        </div>
    </div>
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" id="editPercentageId">
        <div class="form-group row">
            <label class="form-control-label" for="percentage_id">Porcentaje</label>
            <select name="percentage_id" class="form-control selectpicker" id="percentage_id"
                data-live-search="true">
                <option value="1" disabled selected>Seleccionar.</option>
                @foreach($percentages as $percentage)
                <option
                    value="{{ $percentage->id }}_{{ $percentage->percentage }}">{{ $percentage->percentage }} - {{ $percentage->concept }}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="clearfix"></div>
    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12" id="editStock">
        <div class="form-group">
            <label class="form-control-label" for="stock">Stock</label>
            <input type="number" id="stock" name="stock" value="{{ old('stock') }}" class="form-control"
                placeholder="stock" disabled pattern="[0-9]{0,15}">
        </div>
    </div>
    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12" id="editIva">
        <div class="form-group">
            <label class="form-control-label" for="tax_rate">Iva</label>
            <input type="number" id="tax_rate" name="tax_rate" class="form-control" placeholder="Iva" disabled
                pattern="[0-9]{0,15}">
        </div>
    </div>
    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12" id="editVprice">
        <div class="form-group">
            <label for="vprice">V/Actual</label>
            <input type="number" name="vprice" id="vprice"  class="form-control" readonly>
        </div>
    </div>
    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12" id="editPercentage">
        <div class="form-group">
            <label class="form-control-label" for="percentage">% Ret</label>
            <input type="number" id="percentage" name="percentage" value="0" class="form-control"
                placeholder="V impuesto" disabled pattern="[0-9]{0,15}">
        </div>
    </div>
    @if ($retention != null)
    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12" id="editRetentionold">
        <div class="form-group">
            <label class="form-control-label" for="retentionold">% Ret</label>
            <input type="number" id="retentionold" name="retentionold" value="{{ $retention->retention }}" class="form-control"
                placeholder="V impuesto" disabled pattern="[0-9]{0,15}">
        </div>
    </div>
    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12" id="editPercentageold">
        <div class="form-group">
            <label class="form-control-label" for="percentageold">% Ret</label>
            <input type="number" id="percentageold" name="percentageold" value="{{ $retention->percentage->id }}" class="form-control"
                placeholder="V impuesto">
        </div>
    </div>
    @else
    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12" id="editRetentionold">
        <div class="form-group">
            <label class="form-control-label" for="retentionold">% Ret</label>
            <input type="number" id="retentionold" name="retentionold" value="0" class="form-control"
                placeholder="V impuesto" disabled pattern="[0-9]{0,15}">
        </div>
    </div>
    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12" id="editPercentageold">
        <div class="form-group">
            <label class="form-control-label" for="percentageold">% Ret</label>
            <input type="number" id="percentageold" name="percentageold" value="0 class="form-control"
                placeholder="V impuesto">
        </div>
    </div>
    @endif
    <div class="clearfix"></div>

    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12" id="editProductId">
        <div class="form-group row">
            <label class="form-control-label" for="product_id">Producto</label>
                <select name="product_id" class="form-control selectpicker" id="product_id" data-live-search="true">
                    <option value="0" disabled selected>Seleccionar el Producto</option>
                    @foreach($products as $product)
                        <option value="{{ $product->id }}_{{ $product->stock }}_{{ $product->price }}_{{ $product->category->tax_rate }}">{{ $product->name }}</option>
                    @endforeach
                </select>
        </div>
    </div>
    <div class="col-lg-2 col-md-3 col-sm-4 col-xs-12" id="editQuantity">
        <div class="form-group">
            <label class="form-control-label" for="quantity">Cantidad</label>
            <input type="number" id="quantity" name="quantity" value=""
                class="form-control" placeholder="Cantidad" pattern="[0-9]{0,15}">
        </div>
    </div>
    <div class="col-lg-2 col-md-3 col-sm-4 col-xs-12" id="editPrice">
        <div class="form-group">
            <label class="form-control-label" for="price">Precio</label>
            <input type="number" id="price" name="price" class="form-control"
                placeholder="Precio">
        </div>
    </div>
    <div class="col-lg-2 col-md-3 col-sm-2 col-xs-12" id="editAdd">
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
                        <th>%</th>
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
                        <th colspan="8" class="rightfoot">TOTAL:</th>
                        <td class="rightfoot thfoot"><strong id="total_html">$ 0.00</strong>
                            <input type="hidden" name="total" id="total"></td>
                    </tr>
                    <tr>
                        <th colspan="8" class="rightfoot">TOTAL IVA:</th>
                        <td class="rightfoot thfoot"><strong id="total_tax_html">$ 0.00</strong>
                            <input type="hidden" name="total_tax" id="total_tax">
                        </td>
                    </tr>
                    <tr id="rtferase">
                        <th colspan="8" class="rightfoot">RETENCION:</th>
                        <td class="rightfoot thfoot"><strong id="retention_html">$ 0.00</strong>
                            <input type="hidden" name="retention" id="retention"></td>
                    </tr>
                    <tr id="rtftotal">
                        <th colspan="8" class="rightfoot">TOTAL - DESC:</th>
                        <td class="rightfoot thfoot"><strong id="total_desc_html">$ 0.00</strong>
                            <input type="hidden" name="total_desc" id="total_desc"></td>
                    </tr>
                    <tr>
                        <th colspan="8" class="rightfoot">TOTAL PAGAR:</th>
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
