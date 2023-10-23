<script>
    /*$(document).ready(function(){
            alert('estoy funcionando correctamanete empresa');
        });*/
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
            $('#customer_id').select2({
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
    var cont = 0;
    var total = 0;
    var subtotal = [];
    var total_tax = 0;
    var tax_iva = 0;
    var total_pay = 0;
    var total_desc = 0;
    var uvt = '';
    var pos_on = '';
    //form invoice
    $("#idPro").hide();
    $("#percent").hide();
    $("#taxType").hide();
    $("#resolution").hide();
    $("#documentType").hide();
    $("#uvt5").hide();
    $("#posActive").hide();
    $("#save").hide();

    $(document).ready(function(){
            typeInvoice = $("#pos_active").val();
            if (typeInvoice == 'off') {
                $("#resolution").show();
                $("#addFe").hide();
                $(".fe_true").val(1);
                $('#resolution_id').prop("required", true)
            }
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
        quantity= $("#quantityadd").val();
        price= $("#price").val();
        stock= $("#stock").val();
        tax_rate= $("#tax_rate").val();
        tax_type = $("#tax_type").val();
        uvt = $("#uvtmax").val();
        pos_on = $("#pos_active").val();
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
        $("#quantityadd").val("");
        $("#price").val("");
    }
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
        $("#total_invoice").val(total.toFixed(2));
        $("#tax_iva").val(tax_iva);
        pos();
    }

    function pos(){
        if (pos_on == 'on') {
            if (total > uvt) {
                $("#resolution").show();
                $(".fe_true").val(1);
                $("#addFe").hide();
                //$("#resolution_id").val(1);
                $('#resolution_id').prop("required", true)
            } else {
                $("#resolution").hide();
                $("#addFe").show();
                $(".fe_true").val(2);
                //$("#resolution_id").val(1);
                $('#resolution_id').prop("required", false)
            }
        }
    }

    $(document).ready(function(){
        $("#fe_on").click(function(){
            $(".fe_true").val(1);
            $("#resolution").show();
            $("#addFe").hide();
            $('#resolution_id').prop("required", true)
            $("#addPercentage").show();
        });
    });
    $(document).ready(function(){
        $("#fe_off").click(function(){
            $(".fe_true").val(2);
            $("#resolution").hide();
            $("#resolution_id").val(4);
            $('#resolution_id').prop("required", false)
        });
    });
    /*
    $(".fe_true").change(function(){
        var fe = $(".fe_true").val();
        if (fe == 1) {
            $("#resolution").show();
            $("#addFe").hide();
            $('#resolution_id').prop("required", true)
        } else {
            $("#resolution").hide();
            //$(".fe_true").val(2);
            //$("#addFe").show();
            $("#resolution_id").val(4);
            $('#resolution_id').prop("required", false)
        }
    });*/
    function assess(){

        if(total>0){

        $("#save").show();
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
        if (pos_on == on) {
            pos();
        }
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
            $("#idModal").val(row.find("td:eq(2)").text());
            $("#product_idModal").val(row.find("td:eq(2)").text());
            $("#productModal").val(row.find("td:eq(3)").text());
            $("#quantityModal").val(row.find("td:eq(4)").text());
            $("#priceModal").val(row.find("td:eq(5)").text());
            $("#taxModal").val(row.find("td:eq(6)").text());
            $("#subtotalModal").val(row.find("td:eq(7)").text());

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
    $('#priceModal').prop("readonly", true);

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
