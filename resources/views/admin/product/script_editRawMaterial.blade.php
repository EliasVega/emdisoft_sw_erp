<script>
    /*$(document).ready(function(){
            alert('estoy funcionando correctamanete empresa');
        });*/
    jQuery(document).ready(function($){
        $(document).ready(function() {
            $('#percentage_id').select2({
                theme: "classic",
                width: "100%",
            });
        });
    });
    jQuery(document).ready(function($){
        $(document).ready(function() {
            $('#product_id').select2({
                theme: "classic",
                width: "100%",
            });
        });
    });

    var cont=0;
    var total = 0;
    var subtotal = [];
    $("#save").hide();

    $("#raw_material_id").change(productValue);

    function productValue(){
        dataMaterial = document.getElementById('raw_material_id').value.split('_');
        $("#consumer_price").val(dataMaterial[1]);
    }
    $(document).ready(function(){
        $("#add").click(function(){
            add();
        });
    });
    function add(){
        raw_material_id = dataMaterial[0];
        material = $("#raw_material_id option:selected").text();
        quantity = $("#quantity").val();
        consumer_price = $("#consumer_price").val();

        if(raw_material_id !="" && material!="" && quantity!="" && quantity>0 && consumer_price!="" && consumer_price>0){
            subtotal[cont]= parseFloat(quantity) * parseFloat(consumer_price);
            total = total + subtotal[cont];

            var row= '<tr class="selected" id="row'+cont+'"><td><button type="button" class="btn btn-danger btn-sm" onclick="deleterow('+cont+');"><i class="fa fa-times"></i></button></td><td><button type="button" class="btn btn-warning btn-sm btnedit" onclick="editrow('+cont+');"><i class="far fa-edit"></i></button></td></td> <td><input type="hidden" name="raw_material_id[]" value="'+raw_material_id+'">'+raw_material_id+'</td></td> <td><input type="hidden" name="material[]" value="'+material+'">'+material+'</td> <td><input type="hidden" name="quantity[]" value="'+quantity+'">'+quantity+'</td> <td><input type="hidden" name="consumer_price[]" value="'+consumer_price+'">'+consumer_price+'</td><td>$'+subtotal[cont]+' </td></tr>';
            cont++;
            totals();
            $('#materials').append(row);
            clear();
            assess();
        } else {
            //alert("Rellene todos los campos del detalle de la venta");
            Swal.fire({
            type: 'error',
            //title: 'Oops...',
            text: 'Rellene todos los campos',
            });
        }
    }
    function totals(){

        $("#total_html").html("$ " + total.toFixed(2));
        $("#total").val(total.toFixed(2));

        $("#price").val(total.toFixed(2));
    }
    function clear(){
        $("#raw_material_id").val("");
        $("#quantity").val("");
        $("#consumer_price").val("");
    }

    function assess(){

        if(total>0){
            $("#save").show();
        } else{
            $("#save").hide();
        }
    }

    function deleterow(index){
        total = total - subtotal[index];
        $("#total_html").html("$ " + total.toFixed(2));
        $("#total").val(total.toFixed(2));

        $("#price").val(total.toFixed(2));
        $("#row" + index).remove();
        assess();
    }
    function assess(){

        if(total>0){

            $("#save").show();
        } else{
            $("#save").hide();
        }
    }
    jQuery(document).on("click", "#editrow", function () {
        editrow();
    });

    function editrow(index) {

        $("#contMod").hide();
        $("#subtotalMod").hide();
        $("#idMod").hide();

        // Obtener la fila
        var row = $("#row" + index);
        // Solo si la fila existe
        if(row) {

            // Buscar datos en la fila y asignar a campos del formulario:
            // Primera columna (0) tiene ID, segunda (1) tiene nombre, tercera (2) capacidad
            $("#contModal").val(index);
            $("#raw_material_idModal").val(row.find("td:eq(2)").text());
            $("#materialModal").val(row.find("td:eq(3)").text());
            $("#quantityModal").val(row.find("td:eq(4)").text());
            $("#consumer_priceModal").val(row.find("td:eq(5)").text());
            $("#subtotalModal").val(row.find("td:eq(6)").text());

            // Mostrar modal
            $('#editModal').modal('show');
        }
    }

    jQuery(document).on("click", "#updateRawMaterial", function () {
        updaterow();

    });

    function updaterow() {

        // Buscar datos en la fila y asignar a campos del formulario:
        // Primera columna (0) tiene ID, segunda (1) tiene nombre, tercera (2) capacidad
        contedit = $("#contModal").val();

        raw_material_id = $("#raw_material_idModal").val();
        material =  $("#materialModal").val();
        quantity =  $("#quantityModal").val();
        consumer_price =  $("#consumer_priceModal").val();

        if(raw_material_id !="" && material!="" && quantity!="" && quantity>0 && consumer_price!="" && consumer_price>0){
            subtotal[cont]= parseFloat(quantity) * parseFloat(consumer_price);
            total = total + subtotal[cont];

            var row= '<tr class="selected" id="row'+cont+'"><td><button type="button" class="btn btn-danger btn-sm" onclick="deleterow('+cont+');"><i class="fa fa-times"></i></button></td><td><button type="button" class="btn btn-warning btn-sm btnedit" onclick="editrow('+cont+');"><i class="far fa-edit"></i></button></td></td> <td><input type="hidden" name="raw_material_id[]" value="'+raw_material_id+'">'+raw_material_id+'</td></td> <td><input type="hidden" name="material[]" value="'+material+'">'+material+'</td> <td><input type="hidden" name="quantity[]" value="'+quantity+'">'+quantity+'</td> <td><input type="hidden" name="consumer_price[]" value="'+consumer_price+'">'+consumer_price+'</td><td>$'+subtotal[cont]+' </td></tr>';

            cont++;
            deleterow(contedit);
            totals();
            assess();
            $('#materials').append(row);
            $('#editModal').modal('hide');
            //$('#product_id option:selected').remove();
            seePay();
        }else{
            // alert("Rellene todos los campos del detalle de la compra, revise los datos del producto");
            Swal.fire({
                type: 'error',
                //title: 'Oops...',
                text: 'Rellene todos los campos del detalle de la compra',
            })
        }
    }

    //function editing(){
        rawMaterial = {!! json_encode($productRawMaterials) !!};
        rawMaterial.forEach((value, i) => {
            if (value['quantity'] > 0) {

                raw_material_id = value['id'];
                material =  value['name'];
                quantity =  value['quantity'];
                consumer_price =  value['consumer_price'];

                if(raw_material_id !="" && material!="" && quantity!="" && quantity>0 && consumer_price!="" && consumer_price>0){
                    subtotal[cont]= parseFloat(quantity) * parseFloat(consumer_price);
                    total = total + subtotal[cont];

                    var row= '<tr class="selected" id="row'+cont+'"><td><button type="button" class="btn btn-danger btn-sm" onclick="deleterow('+cont+');"><i class="fa fa-times"></i></button></td><td><button type="button" class="btn btn-warning btn-sm btnedit" onclick="editrow('+cont+');"><i class="far fa-edit"></i></button></td></td> <td><input type="hidden" name="raw_material_id[]" value="'+raw_material_id+'">'+raw_material_id+'</td></td> <td><input type="hidden" name="material[]" value="'+material+'">'+material+'</td> <td><input type="hidden" name="quantity[]" value="'+quantity+'">'+quantity+'</td> <td><input type="hidden" name="consumer_price[]" value="'+consumer_price+'">'+consumer_price+'</td><td>$'+subtotal[cont]+' </td></tr>';
                    cont++;
                    totals();
                    $('#materials').append(row);
                    clear();
                    assess();
                } else {
                    //alert("Rellene todos los campos del detalle de la venta");
                    Swal.fire({
                    type: 'error',
                    //title: 'Oops...',
                    text: 'Rellene todos los campos',
                    });
                }
            }
        });
    //}
    function detailclear(){
        rawMaterial = {!! json_encode($productRawMaterials) !!};
        rawMaterial.forEach((value, i) => {
            if (value['quantity'] > 0) {
                deleterow(i);
            }
        });
    }
</script>
