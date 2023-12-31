<script>
    /*$(document).ready(function(){
            alert('estoy funcionando correctamanete empresa');
        });*/

    //Selecciona el municipio de acuerdo al departamento
    $("#department_id").change(function(event) {
        $.get("create/" + event.target.value + "", function(response) {
            $("#municipality_id").empty();
            $("#municipality_id").append(
                "<option value = '#' disabled selected>Seleccionar ...</option>");
            for (i = 0; i < response.length; i++) {
                $("#municipality_id").append("<option value = '" + response[i].id + "'>" + response[i]
                    .name + "</option>");
            }
            $("#municipality_id").selectpicker('refresh');
        });
    });
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
    var cont = 0;
    var total = 0;
    var subtotal = [];
    var tax_cont = [];
    var total_tax = 0;
    //form purchase
    $("#idPro").hide();
    $("#save").hide();
    $("#generat").hide();
    $("#barcodeId").hide();



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

    $(document).on('keyup', '#code', function() {
        var codes = $(this).val();
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
            if (tax_type == 1) {
                tax_iva += ivita;
            }
            var row = '<tr class="selected" id="row' + cont +
                '"><td><button type="button" class="btn btn-danger btn-sm btndelete" onclick="deleterow(' + cont +
                ');"><i class="fas fa-trash"></i></button></td><td><input type="hidden" name="product_id[]"  value="' +
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
            total_tax = total_tax + ivita;

            var row = '<tr class="selected" id="row' + cont +
                '"><td><button type="button" class="btn btn-danger btn-sm btndelete" onclick="deleterow(' + cont +
                ');"><i class="fas fa-trash"></i></button></td><td><input type="hidden" name="product_id[]"  value="' +
                product_id + '">' + product_id + '</td><td><input type="hidden" name="product[]" value="' + product +
                '">' + product + '</td>   <td><input type="hidden" name="quantity[]" value="' + quantity + '">' +
                quantity + '</td> <td><input type="hidden" name="price[]"  value="' + price + '">' + price +
                '</td> <td><input type="hidden" name="tax_rate[]"  value="' + tax_rate + '">' + tax_rate +
                '</td><td> $' + parseFloat(subtotal[cont]).toFixed(2) + '</td></tr>';
            cont++;

            totals();
            assess();
            $('#details').append(fila);
            //$('#product_id option:selected').remove();
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
        $("#product_id").val("");
        $("#quantity").val("");
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

    function eliminar(index) {

        total = total - subtotal[index];
        total_tax = total * tax_rate / 100;
        total_pay = total + total_tax;

        $("#total_html").html("$ " + total.toFixed(2));
        $("#total").val(total.toFixed(2));

        total_pay = total + total_tax;
        $("#total_tax_html").html("$ " + total_tax.toFixed(2));
        $("#total_tax").val(total_tax.toFixed(2));

        $("#total_pay_html").html("$ " + total_pay.toFixed(2));
        $("#total_pay").val(total_pay.toFixed(2));

        $("#fila" + index).remove();
        assess();
    }
</script>
