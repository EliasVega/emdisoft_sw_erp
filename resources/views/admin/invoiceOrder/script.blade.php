<script>
    /*$(document).ready(function(){
            alert('estoy funcionando correctamanete empresa');
        });*/
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
            $('#type').select2({
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
    var uvt = '';
    var pos_on = '';
    let coderepit = 0;
    //form invoice
    $("#idPro").hide();
    $("#percent").hide();
    $("#taxType").hide();
    $("#resolution").hide();
    $("#documentType").hide();
    $("#uvt5").hide();
    $("#posActive").hide();
    $("#save").hide();
    $("#posavtivity").hide();
    $("#barcodeId").hide();
    $("#addEid").hide();
    $("#posnegative").hide();
    $("#addWorkLabor").hide();

    $(document).ready(function(){

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
    //seleccionar de acuerdo al producto
    $("#product_id").change(productValue);

    function productValue(){
        dataProduct = document.getElementById('product_id').value.split('_');

        $("#stock").val(dataProduct[1]);
        $("#vprice").val(dataProduct[2]);
        $("#tax_rate").val(dataProduct[3]);
        $("#tax_type").val(dataProduct[4]);
        $("#price").val(dataProduct[2]);
        $("#employee_id").val(0);
    }



    $("#switch_barcode").change(function(){
        let barcode = $(this).prop("checked");// == true ? 1 : 0;
        if (barcode == true) {
            $("#codeBarcode").show();
            $("#addProductId").hide();
            $("#productBarcode").show();
            $("#employee_id").val(0);
        } else{
            $("#codeBarcode").hide();
            $("#productBarcode").hide();
            $("#addProductId").show();
            $("#employee_id").val(0);
        }
    })
    /*
    function enabledInputCode(inputId, tiempoEnMs) {
        setTimeout(function() {
            var input = document.getElementById(inputId);
            if (input) {
                input.disabled = false;
            }
        }, tiempoEnMs);
    }*/

    function disabledInputCode() {
        document.getElementById('code').disabled = true;
    }

    // Ejemplo de uso: deshabilitar el input con id "miInput" después de 3 segundos (3000 milisegundos)


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
            url: "{{ route('getProduct') }}",
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
        pos_on = $("#pos_active").val();
        if(product_id !="" && quantity!="" && quantity>0  && price!=""){
            subtotal[cont] = parseFloat(quantity) * parseFloat(price);
            total = total+subtotal[cont];
            tr = parseFloat(tax_rate);
            if (tr > 0) {
                ivita = subtotal[cont]*tax_rate/100;
            } else {
                ivita = 0;
            }
            tax_cont[cont] = ivita;
            total_tax = total_tax+ivita;
            if(tax_type == 1){
                tax_iva += ivita;
            }
            subcont = subtotal[cont] + parseFloat(ivita);
            rowsList(cont, employee_id, product_id, product, quantity, price, ivita, tax_rate, subcont);
            /*
            var row= '<tr class="selected" id="row'+cont+'"><td><button type="button" class="btn btn-danger btn-xs btndelete" onclick="deleterow('+cont+');"><i class="fas fa-trash"></i></button></td><td><button type="button" class="btn btn-warning btn-xs btnedit" onclick="editrow('+cont+');"><i class="far fa-edit"></i></button></td><td><input type="hidden" name="employee_id[]"  value="'+employee_id+'">'+employee_id+'</td><td><input type="hidden" name="product_id[]"  value="'+product_id+'">'+product_id+'</td><td><input type="hidden" name="product[]" value="'+product+'">'+product+'</td>   <td><input type="hidden" name="quantity[]" value="'+quantity+'">'+quantity+'</td> <td><input type="hidden" name="price[]"  value="'+price+'">'+price+'</td><td><input type="hidden" name="ivaline[]"  value="'+ivita+'">'+ivita+'</td> <td><input type="hidden" name="tax_rate[]"  value="'+tax_rate+'">'+tax_rate+'</td><td> $'+parseFloat(subtotal[cont]).toFixed(2)+'</td></tr>';*/
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

    $(document).ready(function(){
        $("#add").click(function(){
            add();
        });
    });

    //adicionar productos a la compra
    function add(){
        dataProduct = document.getElementById('product_id').value.split('_');
        product_id = dataProduct[0];
        product = $("#product_id option:selected").text();
        quantity = $("#quantityadd").val();
        stock = $("#stock").val();
        tax_rate = $("#tax_rate").val();
        price = $("#price").val();
        
        pwx = $("#pwx").val();
        if (pwx == 'on') {
            taxRate = parseFloat(tax_rate) + 100;
            price = (parseFloat(price) / parseFloat(taxRate)) * 100;
        }
        tax_type = $("#tax_type").val();
        employee_id = $("#employee_id").val();
        pos_on = $("#pos_active").val();
        if(product_id !="" && quantity!="" && quantity>0  && price!=""){
            subtotal[cont] = parseFloat(quantity) * parseFloat(price);
            total = total+subtotal[cont];
            tr = parseFloat(tax_rate);
            if (tr > 0) {
                ivita = subtotal[cont]*tax_rate/100;
            } else {
                ivita = 0;
            }
            tax_cont[cont] = ivita;
            total_tax = total_tax+ivita;
            if(tax_type == 1){
                tax_iva += ivita;
            }
            subcont = subtotal[cont] + parseFloat(ivita);
            rowsList(cont, employee_id, product_id, product, quantity, price, ivita, tax_rate, subcont);
            /*
            var row= '<tr class="selected" id="row'+cont+'"><td><button type="button" class="btn btn-danger btn-xs btndelete" onclick="deleterow('+cont+');"><i class="fas fa-trash"></i></button></td><td><button type="button" class="btn btn-warning btn-xs btnedit" onclick="editrow('+cont+');"><i class="far fa-edit"></i></button></td><td><input type="hidden" name="employee_id[]"  value="'+employee_id+'">'+employee_id+'</td><td><input type="hidden" name="product_id[]"  value="'+product_id+'">'+product_id+'</td><td><input type="hidden" name="product[]" value="'+product+'">'+product+'</td>   <td><input type="hidden" name="quantity[]" value="'+quantity+'">'+quantity+'</td> <td><input type="hidden" name="price[]"  value="'+price+'">'+parseFloat(price).toFixed(2)+'</td><td><input type="hidden" name="ivaline[]"  value="'+ivita+'">'+parseFloat(ivita).toFixed(2)+'</td> <td><input type="hidden" name="tax_rate[]"  value="'+tax_rate+'">'+tax_rate+'</td><td> $'+parseFloat(subtotal[cont]).toFixed(2)+'</td></tr>';*/
            cont++;
            totals();
            assess();

            $('#details').append(row);
            $("#totalPartial").val(total);
            /*
            swal.fire({
                icon: 'success',
                text: product + '--' + 'Agregado correctamente',
                showConfirmButton: false,
                timer: 3000 // es ms (mili-segundos)
            });*/
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
        $("#total_invoice").val(total.toFixed(2));
        $("#tax_iva").val(tax_iva);
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
            $("#employee_idModal").val(row.find("td:eq(2)").text());
            $("#idModal").val(row.find("td:eq(3)").text());
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

    jQuery(document).on("click", "#updateInvoiceOrder", function () {
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
            tr = parseFloat(tax_rate);
            if (tr > 0) {
                ivita = subtotal[cont]*tax_rate/100;
            } else {
                ivita = 0;
            }
            tax_cont[cont] = ivita;
            total_tax = total_tax+ivita;

            subcont = subtotal[cont] + parseFloat(ivita);
            rowsList(cont, employee_id, product_id, product, quantity, price, ivita, tax_rate, subcont);
            /*
            var row= '<tr class="selected" id="row'+cont+'"><td><button type="button" class="btn btn-danger btn-xs btndelete" onclick="deleterow('+cont+');"><i class="fas fa-trash"></i></button></td><td><button type="button" class="btn btn-warning btn-xs btnedit" onclick="editrow('+cont+');"><i class="far fa-edit"></i></button></td><td><input type="hidden" name="employee_id[]"  value="'+employee_id+'">'+employee_id+'</td><td><input type="hidden" name="product_id[]"  value="'+product_id+'">'+product_id+'</td><td><input type="hidden" name="product[]" value="'+product+'">'+product+'</td>   <td><input type="hidden" name="quantity[]" value="'+quantity+'">'+quantity+'</td> <td><input type="hidden" name="price[]"  value="'+price+'">'+price+'</td> <td><input type="hidden" name="tax_rate[]"  value="'+tax_rate+'">'+tax_rate+'</td><td> $'+parseFloat(subtotal[cont]).toFixed(2)+'</td></tr>';*/
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
    function disabledButton() {
        document.getElementById('registerForm').addEventListener('submit', function() {
            document.getElementById('register').setAttribute('disabled', 'true');
        });
    }

    function rowsList(cont, employee_id, product_id, product, quantity, price, ivita, tax_rate, subcont) {
        row= '<tr class="selected" id="row'+cont+'"><td><button type="button" class="btn btn-danger btn-xs btndelete" onclick="deleterow('+cont+');"><i class="fas fa-trash"></i></button></td><td><button type="button" class="btn btn-warning btn-xs btnedit" onclick="editrow('+cont+');"><i class="far fa-edit"></i></button></td><td><input type="hidden" name="employee_id[]"  value="'+employee_id+'">'+employee_id+'</td><td><input type="hidden" name="product_id[]"  value="'+product_id+'">'+product_id+'</td><td><input type="hidden" name="product[]" value="'+product+'">'+product+'</td>   <td><input type="hidden" name="quantity[]" value="'+quantity+'">'+quantity+'</td> <td><input type="hidden" name="price[]"  value="'+price+'">'+parseFloat(price).toFixed(2)+'</td><td><input type="hidden" name="ivaline[]"  value="'+ivita+'">'+parseFloat(ivita).toFixed(2)+'</td> <td><input type="hidden" name="tax_rate[]"  value="'+tax_rate+'">'+tax_rate+'</td><td> $'+parseFloat(subcont).toFixed(2)+'</td></tr>';
    }
</script>
