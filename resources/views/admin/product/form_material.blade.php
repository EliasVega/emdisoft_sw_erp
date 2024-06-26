<div class="box-body row">
    <div class="col-lg-4 col-md-12 col-sm-12 col-xs-12">
        <div class="card card-primary card-outline">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="form-group">
                        <label for="raw_material_id">Materia Prima</label>
                        <select name="raw_material_id" class="form-control selectpicker" data-live-search="true" id="raw_material_id">
                            <option value="{{ old('row_material_id') }}" disabled selected>Seleccionar.</option>
                            @foreach($rawMaterials as $rawMaterial)
                                <option value="{{ $rawMaterial->id }}_{{ $rawMaterial->price }}">{{ $rawMaterial->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
                    <div class="form-group">
                        <label for="quantity">Cantidad</label>
                        <input type="text" name="quantity" value="0" id="quantity" class="form-control" placeholder="Cantidad segun Medida">
                    </div>
                </div>
                <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
                    <div class="form-group">
                        <label for="consumer_price">Precio</label>
                        <input type="text" name="consumer_price" value="0" id="consumer_price" class="form-control" placeholder="Precio por unidad">
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <div class="form-group">
                        <label class="form-control-label">Adicionar</label><br>
                        <button class="btn btn-lightBlueGrad" type="button" id="add" data-toggle="tooltip" data-placement="top" title="Adicionar"><i class="fas fa-check"></i> </button>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <div class="form-group">
                        <label class="form-control-label" >Canc</label><br>
                        <a href="{{url('product')}}" class="btn btn-blueGrad" data-toggle="tooltip" data-placement="top" title="Cancelar"><i class="fa fa-window-close"></i>&nbsp; </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-8 col-md-12 col-sm-12 col-xs-12">
        <div class="card card-primary card-outline">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="table-responsive">
                        <table id="materials" class="table table-striped table-bordered table-condensed table-hover">
                            <thead class="bg-info">
                                <tr>
                                    <th>Eliminar</th>
                                    <th>Editar</th>
                                    @if ($operation == 'edit')
                                        <th>Id</th>
                                    @endif
                                    <th>Materia Prina</th>
                                    <th>Cantidad</th>
                                    <th>Valor</th>
                                    <th>Total</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th colspan="{{ $cols }}">
                                        <p align="right">TOTAL:</p>
                                    </th>
                                    <th>
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
                <div class="box-body">
                    @if (indicator()->raw_material == 'off')
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="form-group">
                                <button class="btn btn-lightBlueGrad btn-md mt-3" type="submit"><i class="fa fa-save"></i>&nbsp; Guardar</button>
                                <a href="{{url('product')}}" class="btn btn-blueGrad mt-3"><i class="fa fa-window-close"></i>&nbsp; Cancelar</a>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>


