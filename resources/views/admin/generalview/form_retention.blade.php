<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12" id="infoBase">
    <div class="form-group">
        <label class="form-control-label" for="base">Base</label>
        <input type="number" id="base" name="base" class="form-control" value="0"
            pattern="[0-9]{0,15}">
    </div>
</div>
<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12" id="infoType">
    <div class="form-group">
        <label class="form-control-label" for="taxTypeId">Iva</label>
        <input type="number" id="taxTypeId" name="taxTypeId" class="form-control" value="0" disabled
            pattern="[0-9]{0,15}">
    </div>
</div>
<div class="box-body row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="box-danger">
            <span><strong>Agregar Retenciones</strong></span>
        </div>
    </div>
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" id="companyTax">
        <div class="form-group">
            <label class="form-control-label" for="company_tax_id">Retencion</label>
            <select name="company_tax_id" class="form-control selectpicker" id="company_tax_id"
                data-live-search="true">
                <option value="" disabled selected>Seleccionar.</option>
                @foreach($companyTaxes as $companyTax)
                <option
                    value="{{ $companyTax->id }}_{{ $companyTax->percentage }}_{{ $companyTax->ttId }}_{{ $companyTax->base }}">{{ $companyTax->name }}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="col-lg-5 col-md-5 col-sm-6 col-xs-12" id="fPercentage">
        <div class="form-group">
            <label class="form-control-label" for="percentage">Porcentage</label>
            <input type="number" name="percentage" id="percentage" class="form-control" value="0" placeholder="porcentage">
        </div>
    </div>
    <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12">
        <div class="form-group">
            <span><strong>Adicionar</strong></span><br>
            <button class="btn btn-lightBlueGrad" type="button" id="withhold" data-toggle="tooltip" data-placement="top" title="Retencion"><i class="fas fa-check"></i> </button>
        </div>
    </div>
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="table-responsive">
            <table id="retentions" class="table table-striped table-bordered table-condensed table-hover">
                <thead class="bg-info">
                    <tr>
                        <th>Eliminar</th>
                        <th>Tipo</th>
                        <th>Valor</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th colspan="2">
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
<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
    <div class="form-group">
        <button class="btn btn-blueGrad btn-sm mb-2 ml-3" type="button" id="goBack2" data-toggle="tooltip"
            data-placement="top" title="Guardar"><i class="fas fa-check"></i>Guardar</button>
    </div>
</div>
