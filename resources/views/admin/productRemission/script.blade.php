<script>
    /*$(document).ready(function(){
            alert('estoy funcionando correctamanete empresa');
        });*/
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
    var cont = 0;
    var total = 0;
    var subtotal = [];
    var tax_cont = [];
    var total_tax = 0;
    var tax_iva = 0;
    var total_pay = 0;
    var total_desc = 0;
    //form remission
    $("#idPro").hide();
    $("#percent").hide();
    $("#taxType").hide();
    $("#resolution").hide();
    $("#documentType").hide();
    $("#save").hide();
    $("#posavtivity").hide();
    $("#barcodeId").hide();
    //$("#addTypeDocument").hide();
    $("#addUtility").hide();
    $("#posActive").hide();
    $("#doNotLook").hide();
    $("#formPayCard").hide();
    $("#formRetentions").hide();
    $("#addTypeProduct").hide();
    $("#addPay").hide();
    $("#addRetentions").hide();
    $("#addRemissionId").hide();

    $(document).ready(function(){

        typeInvoice = $("#pos_active").val();
        if (typeInvoice == 'on') {
            $("#resolution").show();
            $('#resolution_id').prop("required", true)
        }
    });
    function totals(){
        total_pay = parseFloat(total)  + parseFloat(total_tax);

        $("#total_html").html("$ " + total.toFixed(2));
        $("#total").val(total.toFixed(2));

        $("#total_tax_html").html("$ " + total_tax.toFixed(2));
        $("#total_tax").val(total_tax.toFixed(2));

        $("#total_pay_html").html("$ " + total_pay.toFixed(2));
        $("#total_pay").val(total_pay.toFixed(2));

        $("#balance").val(total_pay.toFixed(2));
        $("#pendient").val(total_pay.toFixed(2));
    }
    function assess(){

        if(total>=0){

            $("#addPay").show();
            $("#addRetentions").show();

        } else{
            $("#addPay").hide();
            $("#addRetentions").hide();
        }
    }
    function editrow(index) {

        $("#contMod").hide();
        $("#subtotalMod").hide();
        $("#idMod").hide();

        // Obtener la row
        var row = $("#row" + index);
        // Solo si la row existe
        if(row) {
            $("#contModal").val(index);
            $("#employee_idModal").val(row.find("td:eq(1)").text());
            $("#idModal").val(row.find("td:eq(2)").text());
            $("#product_idModal").val(row.find("td:eq(2)").text());
            $("#productModal").val(row.find("td:eq(3)").text());
            $("#quantityModal").val(row.find("td:eq(4)").text());
            $("#priceModal").val(row.find("td:eq(5)").text());
            $("#taxModal").val(row.find("td:eq(6)").text());
            $("#subtotalModal").val(row.find("td:eq(7)").text());

            // Buscar datos en la row y asignar a campos del formulario:
            // Primera columna (0) tiene ID, segunda (1) tiene nombre, tercera (2) capacidad

            // Mostrar modal
            $('#editModal').modal('show');
        }
    }

    jQuery(document).on("click", "#updateProductRemission", function () {
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
        employee_id = $("#employee_idModal").val();
        if(product_id !="" && quantity!="" && quantity>0 && price!="" && price>0){
            subtotal[cont]= parseFloat(quantity) * parseFloat(price);
            total = total+subtotal[cont];
            ivita= subtotal[cont]*tax_rate/100;
            tax_cont[cont] = ivita;
            total_tax = total_tax+ivita;
            subcont = subtotal[cont]
            rowsList(cont, employee_id, product_id, product, quantity, price, tax_rate, subcont);
            cont++;

            deleterow(contedit);
            totals();
            assess();
            $('#details').append(row);
            $('#editModal').modal('hide');
            $("#totalPartial").val(total);
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
    function rowsList(cont, employee_id, product_id, product, quantity, price, tax_rate, subcont) {
        indiwl = $("#indicatorwl").val();
        if (indiwl == 'on') {
            row = '<tr class="selected" id="row'+cont+'"><td><button type="button" class="btn btn-warning btn-xs btnedit" onclick="editrow('+cont+');"><i class="far fa-edit"></i></button></td><td><input type="hidden" name="employee_id[]"  value="'+employee_id+'">'+employee_id+'</td><td><input type="hidden" name="product_id[]"  value="'+product_id+'">'+product_id+'</td><td><input type="hidden" name="product[]" value="'+product+'">'+product+'</td>   <td><input type="hidden" name="quantity[]" value="'+quantity+'">'+quantity+'</td> <td><input type="hidden" name="price[]"  value="'+price+'">'+price+'</td> <td><input type="hidden" name="tax_rate[]"  value="'+tax_rate+'">'+tax_rate+'</td><td> $'+parseFloat(subcont).toFixed(2)+'</td></tr>';
        } else {
            row = '<tr class="selected" id="row'+cont+'"><td><button type="button" class="btn btn-warning btn-xs btnedit" onclick="editrow('+cont+');"><i class="far fa-edit"></i></button></td><td><input type="hidden" name="product_id[]"  value="'+product_id+'">'+product_id+'</td><td><input type="hidden" name="product[]" value="'+product+'">'+product+'</td>   <td><input type="hidden" name="quantity[]" value="'+quantity+'">'+quantity+'</td> <td><input type="hidden" name="price[]"  value="'+price+'">'+price+'</td> <td><input type="hidden" name="tax_rate[]"  value="'+tax_rate+'">'+tax_rate+'</td><td> $'+parseFloat(subcont).toFixed(2)+'</td></tr>';
        }
    }

    function deleterow(index){
        total = total - subtotal[index];
        total_tax = total_tax - tax_cont[index];
        total_pay = total + total_tax;

        $("#total_html").html("$ " + total.toFixed(2));
        $("#total").val(total.toFixed(2));

        $("#total_tax_html").html("$ " + total_tax.toFixed(2));
        $("#total_tax").val(total_tax.toFixed(2));

        $("#total_pay_html").html("$ " + total_pay.toFixed(2));
        $("#total_pay").val(total_pay.toFixed(2));

        $("#row" + index).remove();

        assess();
    }

    $(document).ready(function(){
        $("#addPay").click(function(){
            $("#formCard").hide();
            $("#formRetentions").hide();
            $("#formPayCard").show();
            typeOperation = $("#typeOperation").val();
            if (typeOperation == 'edition') {
                assessEdit();
            }
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
        });
    });
    $(document).ready(function(){
        $("#goBack2").click(function(){
            $("#formCard").show();
            $("#formPayCard").hide();
            $("#formRetentions").hide();
        });
    });

    //para traer los productos
    $("#addReverse").hide();
    $("#addRemissionPayments").hide();

    //function editing(){
    pr = {!! json_encode($productRemissions) !!};
    pr.forEach((value, i) => {
        if (value['quantity'] > 0) {
            id = value['id'];
            product_id = value['idP'];
            product = value['name'];
            quantity = value['quantity'];
            price = value['price'];
            tax_rate = value['tax_rate'];
            if (product_id != "" && quantity != "" && quantity > 0 && price != "" && price > 0) {
                subtotal[cont] = parseFloat(quantity) * parseFloat(price);
                total = total + subtotal[cont];
                ivita = subtotal[cont] * tax_rate / 100;
                tax_cont[cont] = ivita;
                total_tax = total_tax + ivita;
                subcont = subtotal[cont];
                employee_id = 'null';
                rowsList(cont, employee_id, product_id, product, quantity, price, tax_rate, subcont);
                cont++;

                totals();
                assess();
                $('#details').append(row);
                $('#editModal').modal('hide');
                $("#totalPartial").val(total);
                //$('#product_id option:selected').remove();
            } else {
                // alert("Rellene todos los campos del detalle de la compra, revise los datos del producto");
                Swal.fire({
                    type: 'error',
                    //title: 'Oops...',
                    text: 'Rellene todos los campos del detalle de la compra',
                })
            }
        }
    });
    //}

    function assessEdit() {
        remissionPayments = $("#remission_payments").val();

        if (remissionPayments < total_pay) {
            pendientEdit = parseFloat(total_pay) - parseFloat(remissionPayments);
            $("#pendient").val(pendientEdit.toFixed(2));
        } else {
            $("#addReverse").show();
            $("#formPayCard").hide();
            $("#formCard").show();
            $("#payment_form_id").val(2);
            $("#payment_method_id").val(1);
            $("#save").show();

        }
    }
</script>
