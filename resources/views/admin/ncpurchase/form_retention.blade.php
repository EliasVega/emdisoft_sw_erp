<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12" id="infoIva">
    <div class="form-group">
        <label class="form-control-label" for="tax_iva">Iva</label>
        <input type="number" id="tax_iva" name="tax_iva" class="form-control" value="0"
            pattern="[0-9]{0,15}">
    </div>
</div>
<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12" id="infoType">
    <div class="form-group">
        <label class="form-control-label" for="taxTypeId">Tipo</label>
        <input type="number" id="taxTypeId" name="taxTypeId" class="form-control" value="0" disabled
            pattern="[0-9]{0,15}">
    </div>
</div>
<div class="box-body row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="box-danger">
            <label class="form-control-label">
                <strong>Retenciones</strong>
            </label>
        </div>
    </div>
    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12" id="fPercentage">
        <div class="form-group">
            <label class="form-control-label" for="percentage">Porcentage</label>
            <input type="number" name="percentage" id="percentage" class="form-control" value="0" placeholder="porcentage">
        </div>
    </div>
    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12" id="ncpurchaseretention">
        <div class="form-group">
            <label class="form-control-label" for="total_ncpurchase">Total factura</label>
            <input type="number" name="total_ncpurchase" id="total_ncpurchase" class="form-control" value="0" placeholder="total">
        </div>
    </div>
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="table-responsive">
            <table id="retentions" class="table table-striped table-bordered table-condensed table-hover">
                <thead class="bg-info">
                    <tr>
                        <th>Eliminar</th>
                        <th>Tipo id</th>
                        <th>Tipo</th>
                        <th>Valor</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th colspan="3">
                            <p align="right">TOTAL RETENCIONES:</p>
                        </th>
                        <th class="thfoot">
                            <p align="right"><span id="total_retention_html">$ 0.00</span>
                                <input type="hidden" name="total_retention" id="total_retention"> </p>
                        </th>
                    </tr>
                </tfoot>
                <tbody>

                </tbody>
            </table>
        </div>
    </div>
</div>
