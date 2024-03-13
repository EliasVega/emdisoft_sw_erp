<div class="box-body row">
    <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
        <div class="form-group">
            <label class="form-control-label" for="idOld">Id</label>
            <input type="text" id="idOld" name="idOld" value="{{ $employeeInvoiceProduct->id }}" class="form-control"
                placeholder="id" readonly>
        </div>
    </div>
    <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
        <div class="form-group">
            <label class="form-control-label" for="prodcutOld">Servicio</label>
            <input type="text" id="prodcutOld" name="prodcutOld" value="{{ $employeeInvoiceProduct->invoiceProduct->product->name }}" class="form-control"
                placeholder="Servicio" readonly>
        </div>
    </div>
    <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
        <div class="form-group">
            <label class="form-control-label" for="quantityOld">Cantidad</label>
            <input type="text" id="quantityOld" name="quantityOld" value="{{ $employeeInvoiceProduct->quantity }}" class="form-control"
                placeholder="Cantidad" readonly>
        </div>
    </div>
    <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
        <div class="form-group">
            <label class="form-control-label" for="priceOld">Valor</label>
            <input type="text" id="priceOld" name="priceOld" value="{{ $employeeInvoiceProduct->price }}" class="form-control"
                placeholder="Valor" readonly>
        </div>
    </div>
    <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
        <div class="form-group">
            <label class="form-control-label" for="subtotalOld">Total</label>
            <input type="text" id="subtotalOld" name="subtotalOld" value="{{ $employeeInvoiceProduct->subtotal }}" class="form-control"
                placeholder="Total" readonly>
        </div>
    </div>

    <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
        <div class="form-group">
            <label class="form-control-label" for="commissionOld">Comision %</label>
            <input type="text" id="commissionOld" name="commissionOld" value="{{ $employeeInvoiceProduct->commission }}" class="form-control"
                placeholder="comision" readonly>
        </div>
    </div>
    <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
        <div class="form-group">
            <label class="form-control-label" for="value_commissionOld">V/Comision</label>
            <input type="text" id="value_commissionOld" name="value_commissionOld" value="{{ $employeeInvoiceProduct->value_commission }}" class="form-control"
                placeholder="Valor comision" readonly>
        </div>
    </div>
    <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
        <div class="form-group">
            <label class="form-control-label" for="statusOld">Estado Pago</label>
            <input type="text" id="statusOld" name="statusOld" value="{{ $employeeInvoiceProduct->status }}" class="form-control"
                placeholder="estado" readonly>
        </div>
    </div>
    <div class="col-lg-6 col-md-4 col-sm-6 col-xs-12">
        <label for="employee_id">Operario</label>
        <div class="select">
            <select id="employee_id" name="employee_id" class="form-control selectpicker" data-live-search="true">
                <option {{ old('employee_id', $employeeInvoiceProduct->employee_id ?? '') == '' ? "selected" : "" }} disabled>Seleccionar Cliente</option>
                @foreach($employees as $employee)
                    @if(old('employee_id', $employeeInvoiceProduct->employee_id ?? '') == $employee->id)
                        <option value="{{ $employee->id }}" selected>{{ $employee->name }}</option>
                    @else
                        <option value="{{ $employee->id }}_{{ $employee->commission }}">{{ $employee->name }}</option>
                    @endif
                @endforeach
            </select>
        </div>
    </div>
</div>
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 mt-3">
        <label><Strong>Cambiar a operario:</Strong></label>
</div>
<div class="box-body row" id="new">

    <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
        <div class="form-group">
            <label class="form-control-label" for="commission">Comision %</label>
            <input type="text" id="commission" name="commission" value="{{ $employeeInvoiceProduct->commission }}" class="form-control"
                placeholder="comision" readonly>
        </div>
    </div>
    <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
        <div class="form-group">
            <label class="form-control-label" for="value_commission">V/Comision</label>
            <input type="text" id="value_commission" name="value_commission" value="{{ $employeeInvoiceProduct->value_commission }}" class="form-control"
                placeholder="Valor comision" readonly>
        </div>
    </div>
    <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
        <div class="form-group">
            <label class="form-control-label" for="status">Estado Pago</label>
            <input type="text" id="status" name="status" value="{{ $employeeInvoiceProduct->status }}" class="form-control"
                placeholder="estado" readonly>
        </div>
    </div>
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="form-group">
            <button class="btn btn-lightBlueGrad btn-md" type="submit"><i class="fa fa-save"></i>Guardar</button>
        </div>
    </div>
</div>
