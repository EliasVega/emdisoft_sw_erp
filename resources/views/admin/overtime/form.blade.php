<div class="box-body row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <label for="department_id">Colaborador</label>
        <div class="select">
            <select id="employee_id" name="employee_id" class="form-control selectpicker" data-live-search="true" required>
                <option {{ ($overtime->employee_id ?? '') == '' ? "selected" : "" }} disabled>Seleccionar Colaborador</option>
                @foreach($employees as $employee)
                    @if($employee->id == ($overtime->employee_id ?? ''))
                        <option value="{{ $employee->id }}" selected>{{ $employee->name }}</option>
                    @else
                        <option value="{{ $employee->id }}">{{ $employee->name }}</option>
                    @endif
                @endforeach
            </select>
        </div>
    </div>
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <label for="department_id">Tipo de hora</label>
        <div class="select">
            <select id="overtime_type_id" name="overtime_type_id" class="form-control selectpicker" data-live-search="true" required>
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
    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
        <div class="form-group">
            <label class="form-control-label" for="start_time">Inicia</label>
            <input type="datetime-local" name="start_time" id="start_time" class="form-control" required>
        </div>
    </div>
    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
        <div class="form-group">
            <label class="form-control-label" for="end_time">Finaliza</label>
            <input type="datetime-local" name="end_time" id="end_time" class="form-control" required>
        </div>
    </div>
    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
        <div class="form-group">
            <button class="btn btn-lightBlueGrad" type="button" id="add"><i class="fa fa-save"></i> Agregar</button>
            <a href="{{url('overtime')}}" class="btn btn-blueGrad"><i class="fa fa-window-close"></i> Cancelar</a>
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
                        <th>Hora %</th>
                        <th>Inicio</th>
                        <th>Fin</th>
                        <th>Quantity</th>
                        <th>Valor</th>
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
</div>
