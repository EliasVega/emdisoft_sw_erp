<script>
    /*$(document).ready(function(){
            alert('estoy funcionando correctamanete empresa');
        });*/

        //Selecciona el municipio de acuerdo al departamento
    $("#department_id").change(function(event){
        $.get("create/" + event.target.value + "", function(response){
            $("#municipality_id").empty();
            $("#municipality_id").append("<option value = '#' disabled selected>Seleccionar ...</option>");
            for(i = 0; i < response.length; i++){
                $("#municipality_id").append("<option value = '" + response[i].id +"'>" + response[i].name + "</option>");
            }
            $("#municipality_id").selectpicker('refresh');
        });
    });
    jQuery(document).ready(function($){
        $(document).ready(function() {
            $('#provider_id').select2({
                theme: "classic",
                width: "100%",
            });
        });
    });
    jQuery(document).ready(function($){
        $(document).ready(function() {
            $('#branch_id').select2({
                theme: "classic",
                width: "100%",
            });
        });
    });
    jQuery(document).ready(function($){
        $(document).ready(function() {
            $('#document_type_id').select2({
                theme: "classic",
                width: "100%",
            });
        });
    });
    jQuery(document).ready(function($){
        $(document).ready(function() {
            $('#resolution_id').select2({
                theme: "classic",
                width: "100%",
            });
        });
    });
    jQuery(document).ready(function($){
        $(document).ready(function() {
            $('#generation_type_id').select2({
                theme: "classic",
                width: "100%",
            });
        });
    });
    var cont = 0;
    var total = 0;
    var subtotal = [];
    var total_tax = 0;
    var tax_iva = 0;
    var total_pay = 0;
    var total_desc = 0;
    var ret = 0;
    var vrte = 0;
    //form purchase
    $("#idPro").hide();
    $("#percent").hide();
    $("#save").hide();

    $("#generat").hide();
    $("#startd").hide();
    $("#resolution").hide();
    $("#invoiceCode").hide();
    $("#prepurch").hide();
    /*
    $("#percentage").val(0);
    */

    //Mostrar u ocultar elementos de acuerdo al tipo de documento
    $(document).ready(function(){
        $("#document_type_id").change(function(){
            var documentType = $("#document_type_id").val();
            if(documentType == 11){
                $("#resolution").show();
                $("#generat").show();
                $("#startd").show();
                $("#invoiceCode").hide();
                $("#invoice_code").val(1);
            }else if(documentType == 25){
                $("#resolution").hide();
                $("#generat").hide();
                $("#startd").hide();
                $("#invoiceCode").show();
                $("#resolution_id").val(1);
            } else {
                $("#resolution").hide();
                $("#generat").hide();
                $("#startd").hide();
                $("#invoiceCode").hide();
                $("#resolution_id").val(1);
            }
        });
    });
    //mostrar de acuerdo al retencion
    $(document).ready(function(){
        $("#rtfon").click(function(){
            $("#percentagey").show();
            $("#rtferase").show();
            $("#percent").show();
        });
    });

    $(document).ready(function(){
        $("#rtfoff").click(function(){
            $("#percentagey").hide();
            $("#rtferase").hide();
            $("#percent").hide();
        });
    });

    purchase = {!! json_encode($purchaseOrderProducts) !!};
    purchase.forEach((value, i) => {
        if (value['quantity'] > 0) {

            product_id= value['id'];
            product= value['name'];
            quantity= value['quantity'];
            price= value['price'];
            stock= value['stock'];
            tax_rate= value['tax_rate'];
            tax_type = value['tax_type_id'];

            if(product_id !="" && quantity!="" && quantity>0  && price!=""){
                subtotal[cont]= parseFloat(quantity) * parseFloat(price);
                total= total+subtotal[cont];
                ivita= subtotal[cont]*tax_rate/100;
                total_tax += ivita;
                if(tax_type == 1){
                    tax_iva += ivita;
                }
                var fila= '<tr class="selected" id="fila'+cont+'"><td><input type="hidden" name="id[]"  value="'+product_id+'">'+product_id+'</td><td><input type="hidden" name="product_id[]" value="'+product_id+'">'+product+'</td> <td><input type="hidden" id="quantity" name="quantity[]" value="'+parseFloat(quantity).toFixed(2)+'">'+quantity+'</td> <td><input type="hidden" id="price" name="price[]" value="'+parseFloat(price).toFixed(2)+'">'+price+'</td> td> <td><input type="hidden" name="tax_rate[]" value="'+tax_rate+'">'+tax_rate+'</td>  <td> $'+parseFloat(subtotal[cont]).toFixed(2)+'</td></tr>';
                cont++;

                totals();
                assess();
                $('#details').append(fila);
            }else{
                //alert("Rellene todos los campos del detalle para esta compra");
                Swal.fire({
                type: 'error',
                //title: 'Oops...',
                text: 'Rellene todos los campos del detalle para esta compra',
                })
            }
        }
    });
    function totals(){
        var total_pay = total + total_tax;

        $("#total_html").html("$ " + total.toFixed(2));
        $("#total").val(total.toFixed(2));

        $("#total_tax_html").html("$ " + total_tax.toFixed(2));
        $("#total_tax").val(total_tax.toFixed(2));

        $("#total_pay_html").html("$ " + total_pay.toFixed(2));
        $("#total_pay").val(total_pay.toFixed(2));

        $("#balance").val(total_pay.toFixed(2));
        $("#pendient").val(total_pay.toFixed(2));
        $("#total_purchase").val(total.toFixed(2));
        $("#tax_iva").val(tax_iva);
    }
    function assess(){

        if(total>0){
            $("#save").show();
        } else{
            $("#save").hide();
        }
    }
</script>
