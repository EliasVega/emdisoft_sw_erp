<div class="box-body row">
    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
        <label for="provider_id">Proveedor</label>
        <div class="select">
            <select id="provider_id" name="provider_id" class="form-control selectpicker" data-live-search="true" required>
                <option {{ old('provider_id', $purchaseOrder->provider_id ?? '') == '' ? "selected" : "" }} disabled>Seleccionar proveedor</option>
                @foreach($providers as $provider)
                    @if($provider->id == ($purchaseOrder->provider_id ?? ''))
                        <option value="{{ $provider->id }}" selected>{{ $provider->name }}</option>
                    @else
                        <option value="{{ $provider->id }}">{{ $provider->name }}</option>
                    @endif
                @endforeach
            </select>
        </div>
    </div>
    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
        <label for="branch_id">Sucursal de Destino</label>
        <div class="select">
            <select id="branch_id" name="branch_id" class="form-control selectpicker" data-live-search="true" required>
                <option {{ old('branch_id', $purchaseOrder->branch_id ?? '') == '' ? "selected" : "" }} disabled>Seleccionar Sucursal</option>
                @foreach($branchs as $branch)
                    @if(old('branch_id', $purchaseOrder->branch_id ?? '') == $branch->id)
                        <option value="{{ $branch->id }}" selected>{{ $branch->name }}</option>
                    @else
                        <option value="{{ $branch->id }}">{{ $branch->name }}</option>
                    @endif
                @endforeach
            </select>
        </div>
    </div>
    <div class="clearfix"></div>
    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
        <div class="form-group">
            <label class="form-control-label" for="stock">Stock</label>
            <input type="number" id="stock" name="stock" value="{{ old('stock') }}" class="form-control"
                placeholder="stock" disabled pattern="[0-9]{0,15}">
        </div>
    </div>
    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
        <div class="form-group">
            <label class="form-control-label" for="tax_rate">Imp%</label>
            <input type="number" id="tax_rate" name="tax_rate" class="form-control" placeholder="% Impuesto" disabled
                pattern="[0-9]{0,15}">
        </div>
    </div>
    <div class="col-lg-3 col-md-2 col-sm-4 col-xs-12">
        <div class="form-group">
            <label for="vprice">V/Actual</label>
            <input type="number" name="vprice" id="vprice"  class="form-control" readonly>
        </div>
    </div>
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
    <div class="col-lg-2 col-md-3 col-sm-4 col-xs-12">
        <div class="form-group">
            <label class="form-control-label" for="quantity">Cantidad</label>
            <input type="number" id="quantity" name="quantity" value=""
                class="form-control" placeholder="Cantidad" pattern="[0-9]{0,15}">
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
            <a href="{{url('purchaseOrder')}}" class="btn btn-blueGrad" data-toggle="tooltip" data-placement="top" title="Cancelar"><i class="fa fa-window-close"></i>&nbsp; </a>
        </div>
    </div>

    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="table-responsive">
            <table id="details" class="table table-striped table-bordered table-condensed table-hover">
                <thead>
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
                        <td class="rightfoot"><strong id="total_html">$ 0.00</strong>
                            <input type="hidden" name="total" id="total"></td>
                    </tr>
                    <tr>
                        <th colspan="7" class="rightfoot">IMPUESTOS:</th>
                        <td class="rightfoot"><strong id="total_tax_html">$ 0.00</strong>
                            <input type="hidden" name="total_tax" id="total_tax">
                        </td>
                    </tr>
                    <tr>
                        <th colspan="7" class="rightfoot">TOTAL PAGAR:</th>
                        <td class="rightfoot"><strong id="total_pay_html">$ 0.00</strong>
                            <input type="hidden" name="total_pay" id="total_pay"></td>
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
