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
            <label for="quantity_overt">C/horas</label>
            <input type="text" name="quantity_overt" value="" id="quantity_overt" class="form-control"  placeholder="Cantidad">
        </div>
    </div>
    <div class="col-lg-2 col-md-6 col-sm-6 col-xs-12" id="addTotalValue">
        <div class="form-group">
            <label for="totalValueOvertime">V/total</label>
            <input type="text" name="totalValueOvertime" value="0" id="totalValueOvertime" class="form-control"  placeholder="valor total">
        </div>
    </div>
    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12 mt-4">
        <div class="form-group">
            <button class="btn btn-lightBlueGrad" type="button" id="add" data-toggle="tooltip"
                data-placement="top" title="Agregar"><i class="fas fa-check"></i></button>


            <button class="btn btn-blueGrad" type="button" id="canc_he" data-toggle="tooltip"
                data-placement="top" title="Cancelar"><i class="fa fa-window-close"></i></button>
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
                            <p align="right"><span id="total_overtime_html">$ 0.00</span>
                                <input type="hidden" name="total_overtime" value="0" id="total_overtime"> </p>
                        </th>
                    </tr>
                </tfoot>
                <tbody>

                </tbody>
            </table>
        </div>
    </div>
</div>
