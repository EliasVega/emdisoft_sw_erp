<div class="box-body row">
    <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
        <label for="department_id">Colaborador</label>
        <div class="select">
            <select id="employee_id" name="employee_id" class="form-control selectpicker" data-live-search="true" disabled>
                <option {{ ($overtime->employee_id ?? '') == '' ? "selected" : "" }} disabled selected>Seleccionar Colaborador</option>
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
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 mt-3">
        <div class="table-responsive">
            <table id="overtime" class="table table-striped table-bordered table-condensed table-hover">
                <thead class="bg-info">
                    <tr>
                        <th>Eliminar</th>
                        <th>Editar</th>
                        <th>id</th>
                        <th>IdTH</th>
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
                        <th colspan="10">
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
