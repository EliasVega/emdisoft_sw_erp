<div class="box-body row">
    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
        <div class="form-group">
            <label class="form-control-label" for="generation_date">Fecha Generacion</label>
            <input type="date" name="generation_date" id="generation_date" class="form-control"
                value="<?php echo date('Y-m-d'); ?>" placeholder="Fecha Vencimiento">
        </div>
    </div>
    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12" id="operadorId">
        <div class="form-group">
            <label class="form-control-label" for="employee_id">operador id</label>
            <input type="text" id="employee_id" name="employee_id" value="{{ $employee->id }}" class="form-control" placeholder="id" required readonly>
        </div>
    </div>
    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12" id="operadorName">
        <div class="form-group">
            <label class="form-control-label" for="employee">operador</label>
            <input type="text" id="employee" name="employee" value="{{ $employee->name }}" class="form-control" placeholder="Operador" required readonly>
        </div>
    </div>
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="table-responsive">
            <table id="details" class="table table-striped table-bordered table-condensed table-hover">
                <thead class="bg-info">
                    <tr>
                        <th>Eliminar</th>
                        <th>Id</th>
                        <th>Fecha</th>
                        <th>Item</th>
                        <th>Cantidad</th>
                        <th>precio ($)</th>
                        <th>SubTotal</th>
                        <th>(%)</th>
                        <th>Comision</th>

                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th colspan="8" class="rightfoot">TOTAL:</th>
                        <td class="rightfoot thfoot"><strong id="total_pay_html">$ 0.00</strong>
                            <input type="hidden" name="total_pay" id="total_pay"></td>
                    </tr>
                </tfoot>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>
    <!--
    <div class="modal-footer" id="save">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="form-group">
                <input type="hidden" name="_token" value="{{csrf_token()}}">
                <button class="btn btn-lightBlueGrad" type="submit"><i class="fa fa-save"></i>&nbsp;
                    Registrar</button>
            </div>
        </div>
    </div>
    -->
</div>
