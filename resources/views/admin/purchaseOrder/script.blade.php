<script>
    /*$(document).ready(function(){
        alert('estoy funcionando correctamanete empresa');
    });*/
    jQuery(document).ready(function($) {
        $(document).ready(function() {
            $('#branch_id').select2({
                theme: "classic",
                width: "100%",
            });
        });
    });
    jQuery(document).ready(function($) {
        $(document).ready(function() {
            $('#provider_id').select2({
                theme: "classic",
                width: "100%",
            });
        });
    });
    jQuery(document).ready(function($) {
        $(document).ready(function() {
            $('#product_id').select2({
                theme: "classic",
                width: "100%",
            });
        });
    });
    let cont = 0;
    let total = 0;
    let subtotal = [];
    let tax_cont = [];
    let total_tax = 0;
    //form purchase
    $("#idPro").hide();
    $("#save").hide();
    $("#generat").hide();
    $("#barcodeId").hide();
    //$("#addTypeProduct").hide();


    $(document).ready(function() {

        let barcodestart = $(("#switch_barcode")).prop("checked"); // == true ? 1 : 0;
        if (barcodestart == true) {
            $("#addProductId").hide();
            $("#codeBarcode").show();
            $("#productBarcode").show();
        } else if (barcodestart == false) {
            $("#codeBarcode").hide();
            $("#productBarcode").hide();
            $("#addProductId").show();
        }
    });

    $("#switch_barcode").change(function() {

        let barcode = $(this).prop("checked"); // == true ? 1 : 0;
        if (barcode == true) {
            $("#codeBarcode").show();
            $("#addProductId").hide();
            $("#productBarcode").show();
        } else {
            $("#codeBarcode").hide();
            $("#productBarcode").hide();
            $("#addProductId").show();
        }
    })


    //$(obtener_registro());
    function obtener_registro(code) {
        $.ajax({
            url: "{{ route('getProductPurchaseOrder') }}",
            type: 'GET',
            dataType: 'json',
            data: {
                code: code,
            }
        }).done(function(data) { // imprimimos la respuesta
            $("#barcode_product_id").val(data.id);
            $("#product_barcode").val(data.name);
            $("#price").val(data.price);
            $("#stock").val(data.stock);
            $("#quantityadd").val(1);
            $("#tax_rate").val(data.percentage);
            $("#tax_type").val(data.tt);
            $("#vprice").val(data.price);
        }).fail(function() {
            //alert("Algo salió mal");
        }).always(function() {
            //alert("Siempre se ejecuta")
        });

    }

    function enabledInputCode(inputId, tiempoEnMs) {
        setTimeout(function() {
            var input = document.getElementById(inputId);
            if (input) {
                input.disabled = false;
            }
        }, tiempoEnMs);
    }

    function disabledInputCode() {
        document.getElementById('code').disabled = true;
    }

    $(document).on('keyup', '#code', function() {
        let codes = $(this).val();
        /*
        disabledInputCode();
        enabledInputCode('code', 2000);*/
        if (codes != "") {
            obtener_registro(codes);
        } else {
            console.log('no hay codigo');
        }
    })

    //adicionar productos a la compra
    function addBarcode() {
        product_id = $("#barcode_product_id").val();
        product = $("#product_barcode").val();
        quantity = $("#quantityadd").val();
        price = $("#price").val();
        stock = $("#stock").val();
        tax_rate = $("#tax_rate").val();
        tax_type = $("#tax_type").val();
        if (product_id != "" && quantity != "" && quantity > 0 && price != "") {
            subtotal[cont] = parseFloat(quantity) * parseFloat(price);
            total = total + subtotal[cont];
            ivita = subtotal[cont] * tax_rate / 100;
            tax_cont[cont] = ivita;
            total_tax = total_tax + ivita;
            let row = '<tr class="selected" id="row' + cont +
                '"><td><button type="button" class="btn btn-danger btn-xs btndelete" onclick="deleterow(' + cont +
                ');"><i class="fas fa-trash"></i></button></td><td><button type="button" class="btn btn-warning btn-xs btnedit" onclick="editrow(' +
                cont +
                ');"><i class="far fa-edit"></i></button></td><td><input type="hidden" name="product_id[]"  value="' +
                product_id + '">' + product_id + '</td><td><input type="hidden" name="product[]" value="' + product +
                '">' + product + '</td>   <td><input type="hidden" name="quantity[]" value="' + quantity + '">' +
                quantity + '</td> <td><input type="hidden" name="price[]"  value="' + price + '">' + price +
                '</td> <td><input type="hidden" name="tax_rate[]"  value="' + tax_rate + '">' + tax_rate +
                '</td><td> $' + parseFloat(subtotal[cont]).toFixed(2) + '</td></tr>';
            cont++;
            totals();
            assess();

            $('#details').append(row);
            clean();
            swal.fire({
                icon: 'success',
                text: product + '--' + 'Agregado correctamente',
                showConfirmButton: false,
                timer: 1000 // es ms (mili-segundos)
            });

        } else {
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

    function productValue() {
        dataProduct = document.getElementById('product_id').value.split('_');
        $("#stock").val(dataProduct[1]);
        $("#vprice").val(dataProduct[2]);
        $("#tax_rate").val(dataProduct[3]);
        $("#tax_type").val(dataProduct[4]);
        $("#price").val(dataProduct[2]);
    }

    $(document).ready(function() {
        $("#add").click(function() {
            let barcodepurchase = $(("#switch_barcode")).prop("checked");
            if (barcodepurchase == true) {
                addBarcode();
            } else {
                add();
            }
        });
    });

    //adicionar productos a la compra
    function add() {
        dataProduct = document.getElementById('product_id').value.split('_');
        product_id = dataProduct[0];
        product = $("#product_id option:selected").text();
        quantity = $("#quantityadd").val();
        price = $("#price").val();
        stock = $("#stock").val();
        tax_rate = $("#tax_rate").val();
        tax_type = $("#tax_type").val();

        if (product_id != "" && quantity != "" && quantity > 0 && price != "") {
            subtotal[cont] = parseFloat(quantity) * parseFloat(price);
            total = total + subtotal[cont];
            ivita = subtotal[cont] * tax_rate / 100;
            tax_cont[cont] = ivita;
            total_tax = total_tax + ivita;
            let row = '<tr class="selected" id="row' + cont +
                '"><td><button type="button" class="btn btn-danger btn-xs btndelete" onclick="deleterow(' + cont +
                ');"><i class="fas fa-trash"></i></button></td><td><button type="button" class="btn btn-warning btn-xs btnedit" onclick="editrow(' +
                cont +
                ');"><i class="far fa-edit"></i></button></td><td><input type="hidden" name="product_id[]"  value="' +
                product_id + '">' + product_id + '</td><td><input type="hidden" name="product[]" value="' + product +
                '">' + product + '</td>   <td><input type="hidden" name="quantity[]" value="' + quantity + '">' +
                quantity + '</td> <td><input type="hidden" name="price[]"  value="' + price + '">' + price +
                '</td> <td><input type="hidden" name="tax_rate[]"  value="' + tax_rate + '">' + tax_rate +
                '</td><td> $' + parseFloat(subtotal[cont]).toFixed(2) + '</td></tr>';
            cont++;
            totals();
            assess();

            $('#details').append(row);
            clean();


        } else {
            //alert("Rellene todos los campos del detalle para esta compra");
            Swal.fire({
                type: 'error',
                //title: 'Oops...',
                text: 'Rellene todos los campos del detalle para esta compra',
            })
        }
    }

    function clean() {
        $('#product_id').val(null).trigger('change');
        $("#barcode_product_id").val("");
        $("#product_barcode").val("");
        $("#code").val("");
        $("#quantityadd").val(1);
        $("#price").val("");
    }

    function totals() {

        $("#total_html").html("$ " + total.toFixed(2));
        $("#total").val(total.toFixed(2));

        total_pay = total + total_tax;

        $("#total_tax_html").html("$ " + total_tax.toFixed(2));
        $("#total_tax").val(total_tax.toFixed(2));

        $("#total_pay_html").html("$ " + total_pay.toFixed(2));
        $("#total_pay").val(total_pay.toFixed(2));
    }

    function assess() {

        if (total > 0) {

            $("#save").show();

        } else {
            $("#save").hide();
        }
    }

    function deleterow(index) {

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
        if (row) {

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

    jQuery(document).on("click", "#updatePurchaseOrder", function() {
        updaterow();

    });

    function updaterow() {

        // Buscar datos en la fila y asignar a campos del formulario:
        // Primera columna (0) tiene ID, segunda (1) tiene nombre, tercera (2) capacidad
        contedit = $("#contModal").val();
        //id = $("#idModal").val();
        product_id = $("#product_idModal").val();
        product = $("#productModal").val();
        quantity = $("#quantityModal").val();
        price = $("#priceModal").val();
        tax_rate = $("#taxModal").val();
        percentage_id = $("#percentageold").val();

        $('#priceModal').prop("readonly", true)

        if (product_id != "" && quantity != "" && quantity > 0 && price != "" && price > 0) {
            subtotal[cont] = parseFloat(quantity) * parseFloat(price);
            total = total + subtotal[cont];
            ivita = subtotal[cont] * tax_rate / 100;
            tax_cont[cont] = ivita;
            total_tax = total_tax + ivita;

            var row = '<tr class="selected" id="row' + cont +
                '"><td><button type="button" class="btn btn-danger btn-xs btndelete" onclick="deleterow(' + cont +
                ');"><i class="fas fa-trash"></i></button></td><td><button type="button" class="btn btn-warning btn-xs btnedit" onclick="editrow(' +
                cont + ');"><i class="far fa-edit"></i></button></td><td><input type="hidden" name="id[]"  value="' +
                product_id + '">' + product_id + '</td><td><input type="hidden" name="product_id[]" value="' +
                product_id + '">' + product + '</td>   <td><input type="hidden" name="quantity[]" value="' + quantity +
                '">' + quantity + '</td> <td><input type="hidden" name="price[]"  value="' + price + '">' + price +
                '</td> <td><input type="hidden" name="tax_rate[]"  value="' + tax_rate + '">' + tax_rate +
                '</td><td>$' + subtotal[cont] + ' </td></tr>';

            cont++;
            deleterow(contedit);
            totals();
            assess();
            $('#details').append(row);
            $('#editModal').modal('hide');
            //$('#product_id option:selected').remove();
            seePay();
        } else {
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
</script>
