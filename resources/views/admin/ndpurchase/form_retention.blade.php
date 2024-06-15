<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12" id="infoIva">
    <div class="form-group">
        <label class="form-control-label" for="tax_iva">Iva</label>
        <input type="number" id="tax_iva" name="tax_iva" class="form-control" value="0"
            pattern="[0-9]{0,15}">
    </div>
</div>
<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12" id="infoType">
    <div class="form-group">
        <label class="form-control-label" for="taxTypeId">Tipo</label>
        <input type="number" id="taxTypeId" name="taxTypeId" class="form-control" value="0" disabled
            pattern="[0-9]{0,15}">
    </div>
</div>
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
    <div class="box-danger">
        <span><strong>Retenciones</strong></span><br>
    </div>
</div>
<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12" id="fPercentage">
    <div class="form-group">
        <label class="form-control-label" for="percentage">Porcentage</label>
        <input type="number" name="percentage" id="percentage" class="form-control" value="0" placeholder="porcentage">
    </div>
</div>
<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12" id="ndpurchaseretention">
    <div class="form-group">
        <label class="form-control-label" for="total_ndpurchase">Total factura</label>
        <input type="number" name="total_ndpurchase" id="total_ndpurchase" class="form-control" value="0" placeholder="total">
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
                    <th>
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
<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
    <div class="form-group">
        <button class="btn btn-blueGrad btn-sm mb-2 ml-3" type="button" id="goBack2" data-toggle="tooltip"
            data-placement="top" title="Guardar"><i class="fas fa-check"></i>Guardar</button>
    </div>
</div>
