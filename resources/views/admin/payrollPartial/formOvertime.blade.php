<div class="box-body row">
    <div class="col-lg-4 col-md-12 col-sm-12 col-xs-12">
        <label for="department_id">Tipo de hora</label>
        <div class="select">
            <select id="overtime_type_id" name="overtime_type_id" class="form-control selectpicker" data-live-search="true">
                <option {{ ($overtime->overtime_type_id ?? '') == '' ? "selected" : "" }} disabled>Tipo de Hora</option>
                @foreach($overtimeTypes as $overtimeType)
                    @if($overtimeType->id == ($overtime->overtime_type_id ?? ''))
                        <option value="{{ $overtimeType->id }}" selected>{{ $overtimeType->code }}</option>
                    @else
                        <option value="{{ $overtimeType->id }}_{{ $overtimeType->percentage }}">{{ $overtimeType->code }} --{{ $overtimeType->hour_type }}</option>
                    @endif
                @endforeach
            </select>
        </div>
    </div>
    <div class="col-lg-2 col-md-6 col-sm-6 col-xs-12" id="addquantity">
        <div class="form-group">
            <label for="quantity">C/horas</label>
            <input type="text" name="quantity" value="" id="quantity" class="form-control"  placeholder="Cantidad">
        </div>
    </div>
    <div class="col-lg-2 col-md-6 col-sm-6 col-xs-12" id="addTotalValue">
        <div class="form-group">
            <label for="totalValue">V/total</label>
            <input type="text" name="totalValue" value="0" id="totalValue" class="form-control"  placeholder="valor total">
        </div>
    </div>
    <div class="col-lg-4 col-md-12 col-sm-12 col-xs-12 mt-4">
        <div class="form-group">
            <button class="btn btn-lightBlueGrad" type="button" id="add"><i class="fa fa-save"></i> Agregar</button>
            <button class="btn btn-darkBlueGrad" type="button" id="canc_he"><i class="fa fa-save"></i> Cancelar</button>
        </div>
    </div>
    <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12" id="addPercentage">
        <div class="form-group">
            <label for="percentage">Porcentage</label>
            <input type="number" name="percentage" value="" id="percentage" class="form-control"  placeholder="Porcentage hora">
        </div>
    </div>
    <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12" id="addWeeklyHours">
        <div class="form-group">
            <label for="weekly_hours">Horas semanales</label>
            <input type="number" name="weekly_hours" value="" id="weekly_hours" class="form-control"  placeholder="Porcentage hora">
        </div>
    </div>
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="table-responsive">
            <table id="overtimes" class="table table-striped table-bordered table-condensed table-hover">
                <thead class="bg-info">
                    <tr>
                        <th>Eliminar</th>
                        <th>Editar</th>
                        <th>idTH</th>
                        <th>T/hora</th>
                        <th>Horas</th>
                        <th>V/hora</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th colspan="6">
                            <p align="right">TOTAL:</p>
                        </th>
                        <th class="thfoot">
                            <p align="right"><span id="total_html">$ 0.00</span>
                                <input type="hidden" name="total" id="total"> </p>
                        </th>
                    </tr>
                </tfoot>
                <tbody>

                </tbody>
            </table>
        </div>
    </div>
</div>
