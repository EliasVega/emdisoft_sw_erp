@extends("layouts.admin")
@section('titulo')
{{ config('app.name', 'Ecounts') }}
@endsection
@section('content')
<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="box-danger">
            <div class="box-header with-border">
                <h5 class="box-title">Agregar productos a sucursales
                    @can('productBranch.index')
                        <a href="{{ route('productBranch.index') }}" class="btn btn-lightBlueGrad btn-sm ml-3"><i class="fas fa-undo-alt mr-2"></i>Regresar</a>
                    @endcan
                    @can('branch.index')
                        <a href="{{ route('branch.index') }}" class="btn btn-blueGrad btn-sm ml-3"><i class="fas fa-undo-alt mr-2"></i>Inicio</a>
                    @endcan
                </h5>
            </div>
            @if (count($errors)>0)
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{$error}}</li>
                    @endforeach
                </ul>
            </div>
            @endif
            <form action="{{route('product_branch.store')}}" method="POST">
                {{csrf_field()}}
                <div class="box-body row">
                    <div class="col-lg-4 col-md-4 col-sm-3 col-xs-12">
                        <div class="form-group">
                            <label class="form-control-label" for="branch">Sucursal Origen</label>
                            <input type="text" id="branch" value="{{ $branch->name }}" name="sucursal" class="form-control"
                                placeholder="Sucursal" readonly>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                        <div class="form-group row">
                            <label class="form-control-label" for="branch_id">Sucursal Destino</label>
                            <select name="branch_id" class="form-control selectpicker" id="branch_id"
                                data-live-search="true" required>
                                <option value="" disabled selected>Seleccionar Sucursal</option>
                                @foreach($branches as $bra)
                                <option value="{{ $bra->id }}">{{ $bra->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                        <div class="box-danger">
                            <label class="form-control-label">
                                <h4>Agregar Productos</h4>
                            </label>
                        </div>
                    </div>
                    <div class="col-lg-1 col-md-1 col-sm-2 col-xs-12">
                        <div class="form-group idpro" >
                            <label class="form-control-label" for="idP">ID</label>
                            <input type="number" id="idP" name="idP" class="form-control"
                                placeholder="ID" readonly>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
                        <div class="form-group row">
                            <label class="form-control-label" for="product_id">Producto</label>
                            <select name="product_id" class="form-control selectpicker" id="product_id"
                                data-live-search="true">
                                <option value="0" disabled selected>Seleccionar el Producto</option>
                                @foreach($branch_products as $bp)
                                <option
                                    value="{{ $bp->id }}_{{ $bp->idP }}_{{ $bp->stock }}">{{ $bp->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-2 col-sm-3 col-xs-12">
                        <div class="form-group">
                            <label class="form-control-label" for="quantity">Cantidad</label>
                            <input type="number" id="quantity" name="quantity" value="{{ old('quantity') }}"
                                class="form-control" placeholder="Ingrese la cantidad">
                        </div>
                    </div>

                    <div class="col-lg-2 col-md-2 col-sm-3 col-xs-12">
                        <div class="form-group">
                            <label class="form-control-label" for="stock">Stock</label>
                            <input type="number" id="stock" name="stock" class="form-control"
                                placeholder="stock" readonly>
                        </div>
                    </div>


                    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                        <div class="form-group">
                            <label class="form-control-label">Add</label><br>
                            <button class="btn btn-blueGrad" type="button" id="add" data-toggle="tooltip" data-placement="top" title="adicionar"><i class="fas fa-check"></i>&nbsp; </button>
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                        <div class="form-group">
                            <label class="form-control-label" >Canc</label><br>
                            <a href="{{url('product_branch')}}" class="btn btn-blueGrad" data-toggle="tooltip" data-placement="top" title="Cancelar"><i class="fa fa-window-close"></i>&nbsp; </a>
                        </div>
                    </div>
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="table-responsive">
                            <table id="details" class="table table-striped table-bordered table-condensed table-hover">
                                <thead class="th-blueGrad">
                                    <tr class="th-blueGrad">
                                        <th>Eliminar</th>
                                        <th>ID</th>
                                        <th>Producto</th>
                                        <th>stock</th>
                                        <th>Cantidad</th>
                                        <th>Destino</th>
                                    </tr>
                                </thead>
                                <tfoot>

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
            </form>
        </div>
    </div>
</div>

@endsection
@section('scripts')

<script>
    /*$(document).ready(function(){
            alert('estoy funcionando correctamanete empresa');
        });*/
        /*
        jQuery(document).ready(function($){
            $(document).ready(function() {
                $('#sede_id').select2({
                    theme: "classic",
                    width: "100%",
                });
            });
        });*/

        jQuery(document).ready(function($){
            $(document).ready(function() {
                $('#product_id').select2({
                    theme: "classic",
                    width: "100%",
                });
            });
        });

        $(document).ready(function(){
            $("#add").click(function(){
                add();
            });

        });

        var cont=0;
        $("#save").hide();
        $("#product_id").change(productvalue);
        $(".idpro").hide();

        function productvalue(){

            dataProduct = document.getElementById('product_id').value.split('_');
            $("#idP").val(dataProduct[1]);

            dataProduct = document.getElementById('product_id').value.split('_');
            $("#stock").val(dataProduct[2]);
        }

        function add(){
            branch_id = $("#branch_id").val();
            branch= $("#branch_id option:selected").text();
            dataProduct = document.getElementById('product_id').value.split('_');
            product_id= dataProduct[0];
            product= $("#product_id option:selected").text();
            quantity= $("#quantity").val();
            stock= $("#stock").val();
            idp = $("#idP").val();

          if(branch_id != null && product_id !="" && quantity!="" && quantity>0  && stock!=""){

                if(parseInt(stock)>=parseInt(quantity)){

                    var fila= '<tr class="selected" id="fila'+cont+'"><td><button type="button" class="btn btn-danger btn-sm" onclick="removefile('+cont+');"><i class="fa fa-times"></i></button></td> <td><input type="hidden" name="idP[]" value="'+idp+'">'+idp+'</td> <td><input type="hidden" name="product_id[]" value="'+product_id+'">'+product+'</td>  <td><input type="hidden" name="stock[]" value="'+stock+'">'+stock+'</td> <td><input type="hidden" name="quantity[]" value="'+quantity+'">'+quantity+'</td> <td><input type="hidden" name="branch_id[]" value="'+branch_id+'">'+branch+'</td>   </tr>';
                    cont++;

                    assess();
                    $('#details').append(fila);
                    $('#product_id option:selected').remove();
                    clean();
                } else{

                    //alert("La cantidad a vender supera el stock");

                    Swal.fire({
                    type: 'error',
                    //title: 'Oops...',
                    text: 'La cantidad a trasladar supera el stock',

                    })
                }

            }else{

                //alert("Rellene todos los campos del detalle de la venta");

                Swal.fire({
                type: 'error',
                //title: 'Oops...',
                text: 'Rellene todos los campos del detalle de la venta',

                })

            }

     }


     function clean(){
        $("#product_id").val("");
        $("#quantity").val("");
        $("#stock").val("");
        $("#idP").val("");
     }


     function assess(){

         if(cont>0){
           $("#save").show();
           $("#branch_id").hide();

         } else{

           $("#save").hide();
         }
     }

     function removefile(index){

        $("#fila" + index).remove();
        assess();
     }
</script>
@endsection
