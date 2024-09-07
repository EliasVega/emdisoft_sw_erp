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
            //$('#customer_id').trigger('change');
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
    jQuery(document).ready(function($){
        $(document).ready(function() {
            $('#employee_id').select2({
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
    let coderepit = 0;
    //form invoice
    $("#idPro").hide();
    $("#percent").hide();
    $("#taxType").hide();
    $("#resolution").hide();
    $("#documentType").hide();
    $("#save").hide();
    $("#posavtivity").hide();
    $("#barcodeId").hide();
    $("#addEid").hide();
    $("#addcvp").hide();

    //$("#addTypeDocument").hide();
    $("#addBags").hide();
    $("#addUtility").hide();
    $("#posActive").hide();
    $("#invoicenegative").hide();
    $("#doNotLook").hide();
    $("#formPayCard").hide();
    $("#formRetentions").hide();
    $("#addTypeProduct").hide();
    $("#addPay").hide();
    $("#addRetentions").hide();
    $("#addPriceWithTax").hide();

    $(document).ready(function(){
        typeInvoice = $("#pos_active").val();
        if (typeInvoice == 'on') {
            $("#resolution").show();
            $('#resolution_id').prop("required", true);
            $('#generation_date').prop("readonly", true);
        } else {
            $('#generation_date').prop("readonly", false);
        }

        let barcodestart = $(("#switch_barcode")).prop("checked");// == true ? 1 : 0;
        if (barcodestart == true) {
            $("#addProductId").hide();
            $("#codeBarcode").show();
            $("#productBarcode").show();
        } else if(barcodestart == false){
            $("#codeBarcode").hide();
            $("#productBarcode").hide();
            $("#addProductId").show();

        }
    });

    $("#switch_barcode").change(function(){

        let barcode = $(this).prop("checked");// == true ? 1 : 0;
        if (barcode == true) {
            $("#codeBarcode").show();
            $("#addProductId").hide();
            $("#productBarcode").show();
            $("#addcvp").hide();
        } else{
            $("#codeBarcode").hide();
            $("#productBarcode").hide();
            $("#addProductId").show();
            $("#addcvp").show();
        }
    })

    $(document).on('keyup', '#code', function(){
        var codes = $(this).val();
        if (codes != "") {
            if (codes != coderepit) {
                obtener_registro(codes);
                coderepit = codes;
            }
            //obtener_registro(codes);
        } else {
            console.log('no hay codigo');
        }
    })

    //$(obtener_registro());
    function obtener_registro(code){
        $.ajax({
            url: "{{ route('getProductInvoice') }}",
            type: 'GET',
            dataType: 'json',
            data: {
                code: code,
            }
        }).done(function(data){ // imprimimos la respuesta
            $("#barcode_product_id").val(data.id);
            $("#product_barcode").val(data.name);
            $("#price").val(data.sale_price);
            $("#stock").val(data.stock);
            $("#quantityadd").val();
            $("#utility").val(data.utility_rate);
            $("#tax_rate").val(data.percentage);
            $("#tax_type").val(data.tt);
            $("#employee_id").val(0);
            coderepit = data.code;
            addBarcode();
        }).fail(function() {
            //alert("Algo salió mal");
        }).always(function() {
            //alert("Siempre se ejecuta")
        });
    }

    //adicionar productos a la compra
    function addBarcode(){
        product_id= $("#barcode_product_id").val();
        product= $("#product_barcode").val();
        quantity= $("#quantityadd").val();
        stock= $("#stock").val();
        tax_rate= $("#tax_rate").val();
        price= $("#price").val();
        pwx = $("#pwx").val();
        if (pwx == 'on') {
            taxRate = parseFloat(tax_rate) + 100;
            price = (parseFloat(price) / parseFloat(taxRate)) * 100;
        }
        tax_type = $("#tax_type").val();
        employee_id = $("#employee_id").val();
        cv = 2;
        if(product_id !="" && quantity!="" && quantity>0  && price!=""){
            subtotal[cont] = parseFloat(quantity) * parseFloat(price);
            total = total+subtotal[cont];
            ivita = subtotal[cont]*tax_rate/100;
            tax_cont[cont] = ivita;
            total_tax = total_tax+ivita;
            if(tax_type == 1){
                tax_iva += ivita;
            }
            subcont = subtotal[cont] + parseFloat(ivita);
            rowsList(cont, cv, employee_id, product_id, product, quantity, price, ivita, tax_rate, subcont);
            cont++;
            totals();
            assess();

            $('#details').append(row);
            $("#totalPartial").val(total);
            clean();
            swal.fire({
                icon: 'success',
                text: product + '--' + 'Agregado correctamente',
                showConfirmButton: false,
                timer: 1000 // es ms (mili-segundos)
            });

        }else{
            //alert("Rellene todos los campos del detalle para esta compra");
            Swal.fire({
            type: 'error',
            //title: 'Oops...',
            text: 'Rellene todos los campos del detalle para esta compra',
            })
        }
    }

    //seleccionar de acuerdo al producto
    $("#product_id").change(productValue);

    function productValue(){
        dataProduct = document.getElementById('product_id').value.split('_');
        $("#stock").val(dataProduct[1]);
        $("#vprice").val(dataProduct[2]);
        $("#tax_rate").val(dataProduct[3]);
        $("#tax_type").val(dataProduct[4]);
        $("#utility").val(dataProduct[5]);
        $("#price").val(dataProduct[2]);
        $("#employee_id").val(0);
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
        stock= $("#stock").val();
        tax_rate= $("#tax_rate").val();
        price= $("#price").val();
        pwx = $("#pwx").val();
        if (pwx == 'on') {
            taxRate = parseFloat(tax_rate) + 100;
            price = (parseFloat(price) / parseFloat(taxRate)) * 100;
        }
        tax_type = $("#tax_type").val();
        employee_id = $("#employee_id").val();
        cv = $(".cvp").val();
        if(product_id !="" && quantity!="" && quantity>0  && price!=""){
            subtotal[cont] = parseFloat(quantity) * parseFloat(price);
            total = total+subtotal[cont];
            ivita = subtotal[cont]*tax_rate/100;
            tax_cont[cont] = ivita;
            total_tax = total_tax+ivita;
            if(tax_type == 1){
                tax_iva += ivita;
            }
            subcont = subtotal[cont] + parseFloat(ivita);
            rowsList(cont, cv, employee_id, product_id, product, quantity, price, ivita, tax_rate, subcont);
            cont++;
            totals();
            assess();

            $('#details').append(row);
            $("#totalPartial").val(total);
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
        $('#product_id').val(null).trigger('change');
        $('#employee_id').val(null).trigger('change');
        $("#barcode_product_id").val("");
        $("#product_barcode").val("");
        $("#code").val("");
        $("#quantityadd").val(1);
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
    }
    function assess(){
        if(total >= 0){
            $("#addPay").show();
            $("#addRetentions").show();
        } else{
            $("#addPay").hide();
            $("#addRetentions").hide();
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

        $("#balance").val(total_pay.toFixed(2));
        $("#pendient").val(total_pay.toFixed(2));

        $("#row" + index).remove();

        assess();
    }

    function editrow(index) {
        indicv = $("#indicatorcv").val();
        indiwl = $("#indicatorwl").val();

        $("#contMod").hide();
        $("#subtotalMod").hide();
        $("#idMod").hide();

        // Obtener la row
        var row = $("#row" + index);
        // Solo si la row existe
        if(row) {
            if (indicv == 'off' && indiwl == 'off') {
                $("#contModal").val(index);
                $('#cvpinvoice1').prop("checked", false);
                $('#cvpinvoice2').prop("checked", true);
                $("#idModal").val(row.find("td:eq(2)").text());
                $("#product_idModal").val(row.find("td:eq(2)").text());
                $("#productModal").val(row.find("td:eq(3)").text());
                $("#quantityModal").val(row.find("td:eq(4)").text());
                $("#priceModal").val(row.find("td:eq(5)").text());
                $("#ivitaModal").val(row.find("td:eq(6)").text());
                $("#taxModal").val(row.find("td:eq(7)").text());
                $("#subtotalModal").val(row.find("td:eq(8)").text());
            } else if (indicv == 'off' || indiwl == 'off') {
                $("#contModal").val(index);
                $('#cvpinvoice1').prop("checked", false);
                $('#cvpinvoice2').prop("checked", true);
                $("#idModal").val(row.find("td:eq(3)").text());
                $("#product_idModal").val(row.find("td:eq(3)").text());
                $("#productModal").val(row.find("td:eq(4)").text());
                $("#quantityModal").val(row.find("td:eq(5)").text());
                $("#priceModal").val(row.find("td:eq(6)").text());
                $("#ivitaModal").val(row.find("td:eq(7)").text());
                $("#taxModal").val(row.find("td:eq(8)").text());
                $("#subtotalModal").val(row.find("td:eq(9)").text());
            }  else {
                $("#contModal").val(index);
                $('#cvpinvoice1').prop("checked", false);
                $('#cvpinvoice2').prop("checked", true);
                $("#idModal").val(row.find("td:eq(4)").text());
                $("#product_idModal").val(row.find("td:eq(4)").text());
                $("#productModal").val(row.find("td:eq(5)").text());
                $("#quantityModal").val(row.find("td:eq(6)").text());
                $("#priceModal").val(row.find("td:eq(7)").text());
                $("#ivitaModal").val(row.find("td:eq(8)").text());
                $("#taxModal").val(row.find("td:eq(9)").text());
                $("#subtotalModal").val(row.find("td:eq(10)").text());
            }
            // Buscar datos en la row y asignar a campos del formulario:
            // Primera columna (0) tiene ID, segunda (1) tiene nombre, tercera (2) capacidad

            // Mostrar modal
            $('#editModal').modal('show');
        }
    }

    jQuery(document).on("click", "#updateInvoice", function () {
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
        let cvpinv = $(("#cvpinvoice1")).prop("checked");// == true ? 1 : 0;
        if (cvpinv == true) {
            cv = 1;
        } else {
            cv = 2;
        }
        //$('#priceModal').prop("readonly", true);

        if(product_id !="" && quantity!="" && quantity>0 && price!="" && price>0){
            subtotal[cont]= parseFloat(quantity) * parseFloat(price);
            total = total+subtotal[cont];
            ivita= subtotal[cont]*tax_rate/100;
            tax_cont[cont] = ivita;
            total_tax = total_tax+ivita;
            subcont = subtotal[cont] + parseFloat(ivita);
            rowsList(cont, cv, employee_id, product_id, product, quantity, price, ivita, tax_rate, subcont);
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
    function rowsList(cont, cv, employee_id, product_id, product, quantity, price, ivita, tax_rate, subcont) {
        indicv = $("#indicatorcv").val();
        indiwl = $("#indicatorwl").val();
        if (indicv == 'off' && indiwl == 'off') {
            row = '<tr class="selected" id="row'+cont+'"><td><button type="button" class="btn btn-danger btn-xs btndelete" onclick="deleterow('+cont+');"><i class="fas fa-trash"></i></button></td><td><button type="button" class="btn btn-warning btn-xs btnedit" onclick="editrow('+cont+');"><i class="far fa-edit"></i></button></td><td><input type="hidden" name="product_id[]"  value="'+product_id+'">'+product_id+'</td><td><input type="hidden" name="product[]" value="'+product+'">'+product+'</td>   <td><input type="hidden" name="quantity[]" value="'+quantity+'">'+quantity+'</td> <td><input type="hidden" name="price[]"  value="'+price+'">'+parseFloat(price).toFixed(2)+'</td><td><input type="hidden" name="ivaline[]"  value="'+ivita+'">'+ivita.toFixed(2)+'</td> <td><input type="hidden" name="tax_rate[]"  value="'+tax_rate+'">'+tax_rate+'</td><td> $'+parseFloat(subcont).toFixed(2)+'</td></tr>';
        } else if (indicv == 'off') {
            row = '<tr class="selected" id="row'+cont+'"><td><button type="button" class="btn btn-danger btn-xs btndelete" onclick="deleterow('+cont+');"><i class="fas fa-trash"></i></button></td><td><button type="button" class="btn btn-warning btn-xs btnedit" onclick="editrow('+cont+');"><i class="far fa-edit"></i></button></td><td><input type="hidden" name="employee_id[]"  value="'+employee_id+'">'+employee_id+'</td><td><input type="hidden" name="product_id[]"  value="'+product_id+'">'+product_id+'</td><td><input type="hidden" name="product[]" value="'+product+'">'+product+'</td>   <td><input type="hidden" name="quantity[]" value="'+quantity+'">'+quantity+'</td> <td><input type="hidden" name="price[]"  value="'+price+'">'+parseFloat(price).toFixed(2)+'</td><td><input type="hidden" name="ivaline[]"  value="'+ivita+'">'+parseFloat(ivita).toFixed(2)+'</td> <td><input type="hidden" name="tax_rate[]"  value="'+tax_rate+'">'+tax_rate+'</td><td> $'+parseFloat(subcont).toFixed(2)+'</td></tr>';
        } else if (indiwl == 'on'){
            row = '<tr class="selected" id="row'+cont+'"><td><button type="button" class="btn btn-danger btn-xs btndelete" onclick="deleterow('+cont+');"><i class="fas fa-trash"></i></button></td><td><button type="button" class="btn btn-warning btn-xs btnedit" onclick="editrow('+cont+');"><i class="far fa-edit"></i></button></td><td><input type="hidden" name="cv[]"  value="'+cv+'">'+cv+'</td><td><input type="hidden" name="product_id[]"  value="'+product_id+'">'+product_id+'</td><td><input type="hidden" name="product[]" value="'+product+'">'+product+'</td>   <td><input type="hidden" name="quantity[]" value="'+quantity+'">'+quantity+'</td> <td><input type="hidden" name="price[]"  value="'+price+'">'+parseFloat(price).toFixed(2)+'</td><td><input type="hidden" name="ivaline[]"  value="'+ivita+'">'+parseFloat(ivita).toFixed(2)+'</td> <td><input type="hidden" name="tax_rate[]"  value="'+tax_rate+'">'+tax_rate+'</td><td> $'+parseFloat(subcont).toFixed(2)+'</td></tr>';
        } else {
            row = '<tr class="selected" id="row'+cont+'"><td><button type="button" class="btn btn-danger btn-xs btndelete" onclick="deleterow('+cont+');"><i class="fas fa-trash"></i></button></td><td><button type="button" class="btn btn-warning btn-xs btnedit" onclick="editrow('+cont+');"><i class="far fa-edit"></i></button></td><td><input type="hidden" name="cv[]"  value="'+cv+'">'+cv+'</td><td><input type="hidden" name="employee_id[]"  value="'+employee_id+'">'+employee_id+'</td><td><input type="hidden" name="product_id[]"  value="'+product_id+'">'+product_id+'</td><td><input type="hidden" name="product[]" value="'+product+'">'+product+'</td>   <td><input type="hidden" name="quantity[]" value="'+quantity+'">'+quantity+'</td> <td><input type="hidden" name="price[]"  value="'+price+'">'+parseFloat(price).toFixed(2)+'</td><td><input type="hidden" name="ivaline[]"  value="'+ivita+'">'+parseFloat(ivita).toFixed(2)+'</td> <td><input type="hidden" name="tax_rate[]"  value="'+tax_rate+'">'+tax_rate+'</td><td> $'+parseFloat(subcont).toFixed(2)+'</td></tr>';
        }
    }

    $(document).ready(function(){
        $("#addPay").click(function(){
            $("#formCard").hide();
            $("#formRetentions").hide();
            $("#formPayCard").show();
            $("#addTablePay").show();
            $("#codeBarcode").hide();
            $("#addProductId").hide();
            $("#qadd").hide();
            $("#padd").hide();
            $("#btnadd").hide();
        });
    });
    $(document).ready(function(){
        $("#addRetentions").click(function(){
            $("#formCard").hide();
            $("#formPayCard").hide();
            $("#formRetentions").show();
            $("#addTablePay").hide();
            $("#codeBarcode").hide();
            $("#addProductId").hide();
            $("#qadd").hide();
            $("#padd").hide();
            $("#btnadd").hide();
        });
    });
    $(document).ready(function(){
        $("#goBack").click(function(){
            $("#formCard").show();
            $("#formPayCard").hide();
            $("#formRetentions").hide();
            $("#addTablePay").hide();
            $("#addPay").hide();
        });
    });
    $(document).ready(function(){
        $("#goBack2").click(function(){
            $("#formCard").show();
            $("#formPayCard").hide();
            $("#formRetentions").hide();
            $("#addTablePay").hide();
            $("#addRetentions").hide();
        });
    });
    $(document).ready(function(){
        $("#addRefresh").click(function(){
            $.ajax({
                url: "{{ route('getCustomers') }}",
                method: 'GET',
                success: function(data) {
                    $('#customer_id').empty();
                    $.each(data, function(index, option) {
                        $('#customer_id').append(new Option(option.identification + ' - ' + option.name, option.id));
                    });
                    // Refrescar si utilizas un plugin
                    //$('#customer_id').selectpicker('refresh');
                }
            });

        });
    });
    $("#customer_id").change(function(event){
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
    function disabledButton() {
        document.getElementById('registerForm').addEventListener('submit', function() {
            document.getElementById('register').setAttribute('disabled', 'true');
        });
    }
</script>
