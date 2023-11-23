<div class="box-body row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="form-group">
            <label for="raw_material_id">Materia Prima</label>
            <select name="raw_material_id" class="form-control selectpicker" data-live-search="true" id="raw_material_id">
                <option value="{{ old('raw_material_id') }}" disabled selected>Seleccionar.</option>
                @foreach($rawMaterials as $rawMaterial)
                    <option value="{{ $rawMaterial->id }}_{{ $rawMaterial->price }}">{{ $rawMaterial->name }}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" id="editMaterialId">
        <div class="form-group">
            <label for="material_id">Materia Prima</label>
            <select name="material_id" class="form-control selectpicker" data-live-search="true" id="material_id">
                <option value="{{ old('material_id') }}" disabled selected>Seleccionar.</option>
                @foreach($rawMaterials as $rawMaterial)
                    <option value="{{ $rawMaterial->id }}">{{ $rawMaterial->name }}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12" id="idProductRaw">
        <div class="form-group">
            <label for="idProduct">idProdut</label>
            <input type="text" name="idProduct" value="" id="idProduct" class="form-control"  placeholder="idProduct">
        </div>
    </div>
    <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
        <div class="form-group">
            <label for="quantityrm">Cantidad</label>
            <input type="text" name="quantityrm" value="" id="quantityrm" class="form-control" placeholder="Cantidad">
        </div>
    </div>
    <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
        <div class="form-group">
            <label for="consumer_price">Precio</label>
            <input type="text" name="consumer_price" value="0" id="consumer_price" class="form-control" placeholder="Precio">
        </div>
    </div>
    <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12" id="addReferency">
        <div class="form-group">
            <label for="referency">Referencia</label>
            <input type="text" name="referency" id="referency" class="form-control"  placeholder="Referencia">
        </div>
    </div>
    <div class="col-lg-2 col-md-6 col-sm-6 col-xs-12">
        <div class="form-group">
            <label class="form-control-label">Adicionar</label><br>
            <button class="btn btn-lightBlueGrad" type="button" id="addrm" data-toggle="tooltip" data-placement="top" title="Adicionar"><i class="fas fa-check"></i> </button>
        </div>
    </div>
    <div class="col-lg-2 col-md-6 col-sm-6 col-xs-12">
        <div class="form-group">
            <label class="form-control-label" >Canc</label><br>
            <a href="{{url('product')}}" class="btn btn-blueGrad" data-toggle="tooltip" data-placement="top" title="Cancelar"><i class="fa fa-window-close"></i></a>
        </div>
    </div>
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="table-responsive">
            <table id="materials" class="table table-striped table-bordered table-condensed table-hover">
                <thead class="bg-info">
                    <tr>
                        <th>Eliminar</th>
                        <th>Editar</th>
                        <th>Ref</th>
                        <th>idP</th>
                        <th>Id</th>
                        <th>Materia Prina</th>
                        <th>Cantidad</th>
                        <th>Valor</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th colspan="8">
                            <p align="right">TOTAL:</p>
                        </th>
                        <th>
                            <p align="right"><span id="totalrm_html">$ 0.00</span>
                                <input type="hidden" name="totalrm" id="totalrm"> </p>
                        </th>
                    </tr>
                </tfoot>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>
</div>
