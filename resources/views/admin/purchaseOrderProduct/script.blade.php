<script>
    /*$(document).ready(function(){
            alert('estoy funcionando correctamanete empresa');
        });*/
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

    $("#invoicenegative").hide();
    $("#formPayCard").hide();
    $("#formRetentions").hide();
    $("#addTypeProduct").hide();
    $("#addPayButton").hide();
    $("#addRetentionButton").hide();

    $("#generat").hide();
    $("#startd").hide();
    $("#resolution").hide();
    //$("#invoiceCode").hide();
    $("#prepurch").hide();
    $("#documentBis").hide();
    /*
    $("#percentage").val(0);
    */

    $(document).ready(function() {

    typeInvoice = $("#pos_active").val();
        if (typeInvoice == 'on') {
            $("#resolution").show();
            $('#generation_date').prop("readonly", true);
            //$('#resolution_id').prop("required", true)
        } else {
            $('#generation_date').prop("readonly", false);
        }
    });

    //Mostrar u ocultar elementos de acuerdo al tipo de documento
    $(document).ready(function() {
        $("#document_type_id").change(function() {
            var documentType = $("#document_type_id").val();
            if (documentType == 11) {
                $("#resolution").show();
                $("#generat").show();
                $("#startd").show();
                $("#invoiceCode").hide();
                $("#invoice_code").val(1);
                //$("#noteDocument").show();
            } else if (documentType == 101) {
                $("#resolution").hide();
                $("#generat").hide();
                $("#startd").hide();
                $("#invoiceCode").show();
                $("#resolution_id").val(1);
                //$("#noteDocument").show();
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
                var fila= '<tr class="selected" id="fila'+cont+'"><td><input type="hidden" name="product_id[]"  value="'+product_id+'">'+product_id+'</td><td><input type="hidden" name="product[]" value="'+product+'">'+product+'</td> <td><input type="hidden" id="quantity" name="quantity[]" value="'+parseFloat(quantity).toFixed(2)+'">'+quantity+'</td> <td><input type="hidden" id="price" name="price[]" value="'+parseFloat(price).toFixed(2)+'">'+price+'</td> td> <td><input type="hidden" name="tax_rate[]" value="'+tax_rate+'">'+tax_rate+'</td>  <td> $'+parseFloat(subtotal[cont]).toFixed(2)+'</td></tr>';
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
    function assess() {

        if (total > 0) {
            $("#addPayButton").show();
            $("#addRetentionButton").show();
        } else {
            $("#addPayButton").hide();
            $("#addRetentionButton").hide();
        }
    }

    $(document).ready(function(){
        $("#addPay").click(function(){
            $("#formCard").hide();
            $("#formRetentions").hide();
            $("#formPayCard").show();
        });
    });
    $(document).ready(function(){
        $("#addRetentions").click(function(){
            $("#formCard").hide();
            $("#formPayCard").hide();
            $("#formRetentions").show();
        });
    });
    $(document).ready(function(){
        $("#goBack").click(function(){
            $("#formCard").show();
            $("#formPayCard").hide();
            $("#formRetentions").hide();
        });
    });
    $(document).ready(function(){
        $("#goBack2").click(function(){
            $("#formCard").show();
            $("#formPayCard").hide();
            $("#formRetentions").hide();
        });
    });

    $("#provider_id").change(function(event){
        $.get("advance/" + event.target.value + "", function(response){
            $("#advance_id").empty();
            $("#advance_id").append("<option value = '#' disabled selected>Seleccionar ...</option>");
            for(i = 0; i < response.length; i++){
                $("#advance_id").append("<option value = '" + response[i].id + "'>" + response[i].origin + response[i].balance + "</option>");
                advanceBalance = response[i].balance;
            }
            $("#advance_id").selectpicker('refresh');
        });
    });
</script>
