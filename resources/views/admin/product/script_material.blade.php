<script>
    /*$(document).ready(function(){
        alert('estoy funcionando correctamanete empresa');
    });*/
    var cont=0;
    var total = 0;
    var subtotal = [];
    //$("#save").hide();

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

            var row= '<tr class="selected" id="row'+cont+'"><td><button type="button" class="btn btn-danger btn-sm" onclick="destroy('+cont+');"><i class="fa fa-times"></i></button></td><td><button type="button" class="btn btn-warning btn-sm btnedit" onclick="editrow('+cont+');"><i class="far fa-edit"></i></button></td> <td><input type="hidden" name="raw_material_id[]" value="'+raw_material_id+'">'+material+'</td> <td><input type="hidden" name="quantity[]" value="'+quantity+'">'+quantity+'</td> <td><input type="hidden" name="consumer_price[]" value="'+consumer_price+'">'+consumer_price+'</td><td>$'+subtotal[cont]+' </td></tr>';
            cont++;
            totals();
            $('#materials').append(row);
            clear();
            //assess();
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
</script>
