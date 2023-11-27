<div class="box-body row">
    <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
        <label for="department_id">Colaborador</label>
        <div class="select">
            <select id="employee_id" name="employee_id" class="form-control selectpicker" data-live-search="true" required>
                <option {{ ($overtime->employee_id ?? '') == '' ? "selected" : "" }} disabled>Seleccionar Colaborador</option>
                @foreach($employees as $employee)
                    @if($employee->id == ($overtime->employee_id ?? ''))
                        <option value="{{ $employee->id }}" selected>{{ $employee->name }}</option>
                    @else
                        <option value="{{ $employee->id }}_{{ $employee->salary }}">{{ $employee->name }}</option>
                    @endif
                @endforeach
            </select>
        </div>
    </div>
    <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
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
    <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
        <div class="form-group">
            <label class="form-control-label" for="start_time">Inicia</label>
            <input type="datetime-local" name="start_time" id="start_time" class="form-control">
        </div>
    </div>

    <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
        <div class="form-group">
            <label class="form-control-label" for="end_time">Finaliza</label>
            <input type="datetime-local" name="end_time" id="end_time" class="form-control">
        </div>
    </div>
    <div class="col-lg-4 col-md-12 col-sm-12 col-xs-12 mt-4">
        <div class="form-group">
            <button class="btn btn-lightBlueGrad" type="button" id="add"><i class="fa fa-save"></i> Agregar</button>
            <a href="{{url('overtime')}}" class="btn btn-blueGrad"><i class="fa fa-window-close"></i> Cancelar</a>
        </div>
    </div>
    <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12" id="addSalary">
        <div class="form-group">
            <label for="salary">Salario</label>
            <input type="text" name="salary" value="" id="salary" class="form-control"  placeholder="Salario">
        </div>
    </div>
    <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12" id="addPercentage">
        <div class="form-group">
            <label for="percentage">Porcentage</label>
            <input type="text" name="percentage" value="" id="percentage" class="form-control"  placeholder="Porcentage hora">
        </div>
    </div>
    <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12" id="addWeeklyHours">
        <div class="form-group">
            <label for="weekly_hours">Horas semanales</label>
            <input type="text" name="weekly_hours" value="{{ $indicator->weekly_hours }}" id="weekly_hours" class="form-control"  placeholder="Porcentage hora">
        </div>
    </div>
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="table-responsive">
            <table id="overtimes" class="table table-striped table-bordered table-condensed table-hover">
                <thead class="bg-info">
                    <tr>
                        <th>Eliminar</th>
                        <th>Editar</th>
                        <th>T/hora</th>
                        <th>Inicio</th>
                        <th>Fin</th>
                        <th>%</th>
                        <th>Horas</th>
                        <th>V/hora</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th colspan="8">
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
