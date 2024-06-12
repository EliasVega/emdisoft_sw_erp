<div class="box-body row">

    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" id="idMod">
        <div class="form-group">
            <label for="idModal">id</label>
            <input type="text" name="idModal" id="idModal"class="form-control" placeholder="id " readonly>
        </div>
    </div>
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" id="productIdModal">
        <div class="form-group">
            <label for="product_idModal">id</label>
            <input type="number" name="product_idModal" id="product_idModal"class="form-control" placeholder="product_id " readonly>
        </div>
    </div>
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="form-group">
            <label for="productModal">Producto</label>
            <input type="text" name="productModal" id="productModal" class="form-control" placeholder="Producto" readonly>
        </div>
    </div>
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" id="taxmod">
        <div class="form-group">
            <label for="taxModal">tax</label>
            <input type="text" name="taxModal" id="taxModal" class="form-control" placeholder="tax" readonly>
        </div>
    </div>
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="form-group">
            <label for="quantityModal">Cantidad</label>
            <input type="number" name="quantityModal" id="quantityModal" class="form-control" placeholder="Cantidad" readonly>
        </div>
    </div>
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="form-group">
            <label for="priceModal">Precio</label>
            <input type="number" name="priceModal" id="priceModal" class="form-control" placeholder="precio" readonly>
        </div>
    </div>
    @if (indicator()->work_labor == 'on')
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" id="addEmployeeId">
            <div class="form-group row">
                <label class="form-control-label" for="employee_idModal">Operario</label>
                <select name="employee_idModal" class="form-control selectpicker" id="employee_idModal" data-live-search="true">
                    <option value="0" disabled selected>Seleccionar</option>
                    @foreach ($employees as $employee)
                        <option
                            value="{{ $employee->id }}">{{ $employee->identification }} -- {{ $employee->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>
    @endif
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" id="subtotalMod">
        <div class="form-group">
            <label for="subtotalModal">Subtotal</label>
            <input type="text" name="subtotalModal" id="subtotalModal" class="form-control" placeholder="Subtotal">
        </div>
    </div>

    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" id="contMod">
        <div class="form-group">
            <label for="contModal">Cont</label>
            <input type="text" name="contModal" id="contModal" class="form-control" placeholder="cont">
        </div>
    </div>
</div>
