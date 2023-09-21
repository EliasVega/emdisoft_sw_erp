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
            $('#branch_id').select2({
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
            $('#product_id').select2({
                theme: "classic",
                width: "100%",
            });
        });
    });
    var dime = 123456789;
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
    $("#taxType").hide();
    $("#save").hide();

    $("#generat").hide();
    $("#startd").hide();
    $("#resolution").hide();
    $("#invoiceCode").hide();

    //$("#percentage").val(0);


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
            }
        });
    });

    //seleccionar de acuerdo al producto
    $("#product_id").change(productValue);

    function productValue(){
        dataProduct = document.getElementById('product_id').value.split('_');
        $("#stock").val(dataProduct[1]);
        $("#vprice").val(dataProduct[2]);
        $("#tax_rate").val(dataProduct[3]);
        $("#tax_type").val(dataProduct[4]);
        $("#price").val(dataProduct[2]);
    }
    $(document).ready(function(){
        $("#add").click(function(){
            add();
        });
    });

    //adicionar productos a la compra
    function add(){
        dataProduct = document.getElementById('product_id').value.split('_');
        product_id= dataProduct[0];
        product= $("#product_id option:selected").text();
        quantity= $("#quantity").val();
        price= $("#price").val();
        stock= $("#stock").val();
        tax_rate= $("#tax_rate").val();
        tax_type = $("#tax_type").val();
        if(product_id !="" && quantity!="" && quantity>0  && price!=""){
            subtotal[cont] = parseFloat(quantity) * parseFloat(price);
            total = total+subtotal[cont];
            ivita = subtotal[cont]*tax_rate/100;
            total_tax = total_tax+ivita;
            if(tax_type == 1){
                tax_iva += ivita;
            }
            var row= '<tr class="selected" id="row'+cont+'"><td><button type="button" class="btn btn-danger btn-sm btndelete" onclick="deleterow('+cont+');"><i class="fas fa-trash"></i></button></td><td><button type="button" class="btn btn-warning btn-sm btnedit" onclick="editrow('+cont+');"><i class="far fa-edit"></i></button></td><td><input type="hidden" name="id[]"  value="'+product_id+'">'+product_id+'</td><td><input type="hidden" name="product_id[]" value="'+product+'">'+product+'</td>   <td><input type="hidden" name="quantity[]" value="'+quantity+'">'+quantity+'</td> <td><input type="hidden" name="price[]"  value="'+price+'">'+price+'</td> <td><input type="hidden" name="tax_rate[]"  value="'+tax_rate+'">'+tax_rate+'</td><td>$'+subtotal[cont]+' </td></tr>';
            cont++;
            totals();
            assess();
            $('#details').append(row);
            $('#product_id option:selected').remove();
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
        $("#product_id").val("");
        $("#quantity").val("");
        $("#price").val("");
    }
    function totals(){
        //var rte = parseFloat($("#percentage").val());
        //var vrte = total * rte / 100;
        var total_pay = total + total_tax;
        var total_desc = total_pay - vrte;

        $("#total_html").html("$ " + total.toFixed(2));
        $("#total").val(total.toFixed(2));

        $("#total_tax_html").html("$ " + total_tax.toFixed(2));
        $("#total_tax").val(total_tax.toFixed(2));
        /*
        $("#retention_html").html("$ " + vrte.toFixed(2));
        $("#retention").val(vrte.toFixed(2));

        $("#total_desc_html").html("$ " + total_desc.toFixed(2));
        $("#total_desc").val(total_desc.toFixed(2));*/

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
        //$("#percentagey").hide();
        $("#rtfon").attr('disabled','disabled');
        $("#rtfoff").attr('disabled','disabled');
        } else{
            $("#save").hide();
        }
    }
    function deleterow(index){
        total = total - subtotal[index];
        total_tax = total*tax_rate/100;
        total_pay = total + total_tax;

        $("#total_html").html("$ " + total.toFixed(2));
        $("#total").val(total.toFixed(2));

        total_pay=total+total_tax;
        $("#total_tax_html").html("$ " + total_tax.toFixed(2));
        $("#total_tax").val(total_tax.toFixed(2));

        $("#total_pay_html").html("$ " + total_pay.toFixed(2));
        $("#total_pay").val(total_pay.toFixed(2));

        $("#row" + index).remove();
        assess();
    }

    function editrow(index) {

        $("#contMod").hide();
        $("#subtotalMod").hide();
        $("#idMod").hide();

        // Obtener la row
        var row = $("#row" + index);
        // Solo si la row existe
        if(row) {

            // Buscar datos en la row y asignar a campos del formulario:
            // Primera columna (0) tiene ID, segunda (1) tiene nombre, tercera (2) capacidad
            $("#contModal").val(index);
            $("#product_idModal").val(row.find("td:eq(3)").text());
            $("#productModal").val(row.find("td:eq(4)").text());
            $("#quantityModal").val(row.find("td:eq(5)").text());
            $("#priceModal").val(row.find("td:eq(6)").text());
            $("#taxModal").val(row.find("td:eq(7)").text());
            $("#subtotalModal").val(row.find("td:eq(8)").text());

            // Mostrar modal
            $('#editModal').modal('show');
        }
    }

    jQuery(document).on("click", "#updatePurchase", function () {
    updaterow();
    });

    function updaterow() {

    // Buscar datos en la row y asignar a campos del formulario:
    // Primera columna (0) tiene ID, segunda (1) tiene nombre, tercera (2) capacidad
    contedit = $("#contModal").val();
    //id = $("#idModal").val();
    product_id = $("#product_idModal").val();
    product = $("#productModal").val();
    quantity = $("#quantityModal").val();
    price = $("#priceModal").val();
    tax_rate = $("#taxModal").val();
    $('#priceModal').prop("readonly", false)

        if(product_id !="" && quantity!="" && quantity>0 && price!="" && price>0){
            subtotal[cont]= parseFloat(quantity) * parseFloat(price);
            total = total+subtotal[cont];
            ivita= subtotal[cont]*tax_rate/10

            var row= '<tr class="selected" id="row'+cont+'"><td><button type="button" class="btn btn-danger btn-sm btndelete" onclick="deleterow('+cont+');"><i class="fas fa-trash"></i></button></td><td><button type="button" class="btn btn-warning btn-sm btnedit" onclick="editrow('+cont+');"><i class="far fa-edit"></i></button></td><td><input type="hidden" name="id[]"  value="'+product_id+'">'+product_id+'</td><td><input type="hidden" name="product_id[]" value="'+product+'">'+product+'</td>   <td><input type="hidden" name="quantity[]" value="'+quantity+'">'+quantity+'</td> <td><input type="hidden" name="price[]"  value="'+price+'">'+price+'</td> <td><input type="hidden" name="tax_rate[]"  value="'+tax_rate+'">'+tax_rate+'</td><td>$'+subtotal[cont]+' </td></tr>';
            cont++;

            deleterow(contedit);
            totals();
            assess();
            $('#details').append(row);
            $('#editModal').modal('hide');

            //$('#product_id option:selected').remove();
        }else{
            // alert("Rellene todos los campos del detalle de la compra, revise los datos del producto");
            Swal.fire({
                type: 'error',
                //title: 'Oops...',
                text: 'Rellene todos los campos del detalle de la compra',
            })
        }
    }
</script>
