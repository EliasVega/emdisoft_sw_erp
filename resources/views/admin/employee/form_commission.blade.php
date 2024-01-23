<div class="box-body row">
    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12" id="operadorId">
        <div class="form-group">
            <label class="form-control-label" for="employee_id">operador id</label>
            <input type="text" id="employee_id" name="employee_id" value="{{ $employee->id }}" class="form-control" placeholder="id" required readonly>
        </div>
    </div>
    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12" id="operadorName">
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
                        <td class="rightfoot thfoot"><strong id="total_html">$ 0.00</strong>
                            <input type="hidden" name="total" id="total"></td>
                    </tr>
                </tfoot>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>
</div>
