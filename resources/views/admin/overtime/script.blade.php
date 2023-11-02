<script>
    /*$(document).ready(function(){
            alert('estoy funcionando correctamanete colegio');
        });*/
        /*
    jQuery(document).ready(function($){
        $(document).ready(function() {
            $('#employee_id').select2({
                theme: "classic",
                width: "100%",
            });
        });
    });
    jQuery(document).ready(function($){
        $(document).ready(function() {
            $('#overtime_type_id').select2({
                theme: "classic",
                width: "100%",
            });
        });
    });*/
    var cont=0;
    total=0;
    //form purchase
    $("#save").hide();
    //form pay
    $("#mpay").hide();

    //seleccionar de acuerdo al producto
    $("#overtime_type_id").change(overtimeTypeValue);

    function overtimeTypeValue(){

        dataOvertimeType = document.getElementById('overtime_type_id').value.split('_');
        $("#percentage").val(dataOvertimeType[1]);

    }
    $(document).ready(function(){

        $("#add").click(function(){
            add();
        });
    });

    //adicionar productos a la compra
    function add(){

        dataOvertimeType = document.getElementById('overtime_type_id').value.split('_');
        overtime_type_id= dataOvertimeType[0];

        overtimeType= $("#overtime_type_id option:selected").text();
        inicio = new Date($("#start_time").val());
        fin = new Date($("#end_time").val());
        diff1 = fin - inicio;
        diff2 = diff1/100;
        diff = diff2 % 3600;
        alert(diff);
        alert(12 % 5);
        quantity= $("#quantityadd").val();
        price= $("#price").val();
        if(overtime_type_id !="" ){
            subtotal[cont] = parseFloat(quantity) * parseFloat(price);
            total = total+subtotal[cont];

            var row= '<tr class="selected" id="row'+cont+'"><td><button type="button" class="btn btn-danger btn-sm btndelete" onclick="deleterow('+cont+');"><i class="fas fa-trash"></i></button></td><td><button type="button" class="btn btn-warning btn-sm btnedit" onclick="editrow('+cont+');"><i class="far fa-edit"></i></button></td><td><input type="hidden" name="overtime_type_id[]"  value="'+overtime_type_id+'">'+overtime_type_id+'</td><td><input type="hidden" name="overtime_tipe[]" value="'+overtimeType+'">'+overtimeType+'</td>   <td><input type="hidden" name="quantity[]" value="'+quantity+'">'+quantity+'</td> <td><input type="hidden" name="price[]"  value="'+price+'">'+price+'</td> <td><input type="hidden" name="percentage[]"  value="'+percentage+'">'+percentage+'</td><td>$'+subtotal[cont]+' </td></tr>';
            cont++;
            totals();
            assess();
            $('#overtimes').append(row);
            //$('#product_id option:selected').remove();
            clean();


        }else{
            //alert("Rellene todos los campos del detalle para esta compra");
            Swal.fire({
            type: 'error',
            //title: 'Oops...',
            text: 'Rellene todos los campos del detalle para esta compra',
            })
        }
    }
    function clean(){
        $("#overtime_type_id").val("");
        $("#start_time").val("");
        $("#end_time").val("");
    }
    function totals(){

        $("#total_html").html("$ " + total.toFixed(2));
        $("#total").val(total.toFixed(2));
    }
    function assess(){
        if(total>0){
            $("#save").show();
        } else{
            $("#save").hide();
        }
    }
    function eliminar(index){

        total = total-pay[index];

        $("#total_html").html("$ " + total.toFixed(2));
        $("#total").val(total.toFixed(2));

        $("#row" + index).remove();
        assess();
    }
</script>
