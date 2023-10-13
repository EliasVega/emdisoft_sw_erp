<script>
    /*$(document).ready(function(){
        alert('estoy funcionando correctamante empresa');
    });*/

    jQuery(document).ready(function($){
        $(document).ready(function() {
            $('#resolution_id').select2({
                theme: "classic",
                width: "100%",
            });
        });
    });

    jQuery(document).on("click", "#editrow", function () {
        editrow();
    });
    jQuery(document).on("click", "#updateNdinvoice", function () {
        updaterow();
    })

        /*
    $(document).ready(function(){
        $("#updateInvoice").click(function(){
            editrow();
        });
    });*/

    let cont=0;
    let total=0;
    let subtotal=[];
    let total_tax = 0;
    let tax_iva = 0;
    //let tax_ivaedit = 0;
    $("#save").hide();
    $("#idCustomer").hide();
    $("#addproduct").hide();
    $("#addquantity").hide();
    $("#addprice").hide();
    $("#added").hide();
    $("#addtax_rate").hide();
    $("#addstock").hide();
    $("#invoice").hide();
    $("#addReverse").hide();
    $("#documentType").hide();
    $("#addResolution").hide();

    /*
    supportDocument = $("#document_type_id").val();
    if (supportDocument == 11) {
        $("#discrepancy_id").val(2);
        $("#discrepancy").hide();
        cont = 0;
        total = 0;
        subtotal = [];
        total_tax = 0;
        $("#addproduct").hide();
        $("#addquantity").hide();
        $("#addprice").hide();
        $("#added").hide();
        $("#cancelled").hide();
        //$("#updateInvoice").hide();
        $("#addReverse").show();
        $("#addResolution").show();
        editing();
    } else {
        $("#resolution_id").val(3);
    }*/
    /*
    $("#resolution_id").change(function(){
        retentionLoad();
    });*/

    $(document).ready(function(){
        /*
        supportDocument = $("#document_type").val();
        if (supportDocument == 11) {
            $("#discrepancy").hide();
            $("#discrepancy_id").val(2);
            cont = 0;
            total = 0;
            subtotal = [];
            total_tax = 0;
            $("#addproduct").hide();
            $("#addquantity").hide();
            $("#addprice").hide();
            $("#added").hide();
            $("#cancelled").hide();
            //$("#updateInvoice").hide();
            $("#addReverse").show();
            $("#addResolution").show();
            editing();
        } else {*/
            $("#discrepancy_id").change(function(){
                var discrepancy = $("#discrepancy_id").val();
                if(discrepancy == 1){
                    $("#discrepancy").hide();
                    $('#priceModal').prop("readonly", true);
                    cont=0;
                    total=0;
                    subtotal=[];
                    total_tax = 0;

                    $("#addproduct").hide();
                    $("#addquantity").hide();
                    $("#addprice").hide();
                    $("#addtax_rate").hide();
                    $("#addstock").hide();
                    $("#added").hide();
                    //$("#addResolution").show();
                    $("#addReverse").show();

                    editing();
                    retentionLoad();
                } else if (discrepancy == 2) {
                    $("#discrepancy").hide();
                    cont = 0;
                    total = 0;
                    subtotal = [];
                    total_tax = 0;
                    $("#addproduct").hide();
                    $("#addquantity").hide();
                    $("#addprice").hide();
                    $("#added").hide();
                    $("#cancelled").hide();
                    //$("#addResolution").show();
                    $("#addReverse").show();
                    editing();
                    retentionLoad();
                } else if (discrepancy == 3) {
                    $("#discrepancy").hide();
                    $('#quantityModal').prop("readonly", true);
                    $('#priceModal').prop("readonly", false);
                    cont=0;
                    total=0;
                    subtotal=[];
                    total_tax = 0;

                    $("#addproduct").hide();
                    $("#addquantity").hide();
                    $("#addprice").hide();
                    $("#addtax_rate").hide();
                    $("#addstock").hide();
                    $("#added").hide();
                    //$("#addResolution").show();
                    $("#addReverse").show();
                    editing();
                    retentionLoad();
                } else if (discrepancy == 4) {
                    $("#discrepancy").hide();
                    $('#quantityModal').prop("readonly", true);
                    $('#priceModal').prop("readonly", false);
                    cont=0;
                    total=0;
                    subtotal=[];
                    total_tax = 0;

                    $("#addproduct").hide();
                    $("#addquantity").hide();
                    $("#addprice").hide();
                    $("#addtax_rate").hide();
                    $("#addstock").hide();
                    $("#added").hide();
                    //$("#addResolution").show();
                    $("#addReverse").show();
                    editing();
                    retentionLoad();
                }
            });
        //}
    });

    function editing(){

        discrep = $("#discrepancy_id").val();
        ncinvoice = {!! json_encode($invoiceProducts) !!};
        ncinvoice.forEach((value, i) => {
            if (value['quantity'] > 0) {

                id = value['id'];
                product_id= value['idP'];
                product= value['name'];
                quantity= value['quantity'];
                price= value['price'];
                stock= value['stock'];
                tax_rate= value['tax_rate'];
                taxType = value['idtt'];

                if(product_id !="" && quantity!="" && quantity>0  && price!="" && price>0){
                    subtotal[cont]= parseFloat(quantity) * parseFloat(price);
                    total= total+subtotal[cont];
                    ivita= subtotal[cont]*tax_rate/100;
                    total_tax=total_tax+ivita;
                    if(taxType == 1){
                        tax_iva += ivita;
                    }

                    var row= '<tr class="selected" id="row'+cont+'"><td><button type="button" class="btn btn-danger btn-sm btndelete" onclick="deleterow('+cont+');"><i class="fas fa-trash"></i></button></td><td><button type="button" class="btn btn-warning btn-sm btnedit" onclick="editrow('+cont+');"><i class="far fa-edit"></i></button></td><td><input type="hidden" name="ttid[]"  value="'+taxType+'">'+taxType+'</td><td><input type="hidden" name="id[]"  value="'+product_id+'">'+product_id+'</td><td><input type="hidden" name="product_id[]" value="'+product_id+'">'+product+'</td>   <td><input type="hidden" name="quantity[]" value="'+quantity+'">'+quantity+'</td> <td><input type="hidden" name="price[]"  value="'+price+'">'+price+'</td> <td><input type="hidden" name="tax_rate[]"  value="'+tax_rate+'">'+tax_rate+'</td><td>'+subtotal[cont]+' </td></tr>';
                    cont++;

                    totals();
                    assess();
                    $('#details').append(row);

                    $('#product_id option:selected').remove();
                    clean();

                    if (discrep == 1) {
                        $('.btnedit').prop("disabled", false);
                        $('.btndelete').prop("disabled", false);
                    } else if (discrep == 2){
                        $('.btnedit').prop("disabled", true);
                        $('.btndelete').prop("disabled", true);
                    } else if (discrep == 3){
                        $('.btnedit').prop("disabled", false);
                        $('.btndelete').prop("disabled", true);
                    } else if (discrep == 4){
                        $('.btnedit').prop("disabled", false);
                        $('.btndelete').prop("disabled", true);
                    }
                }else{
                    //alert("Rellene todos los campos del detalle para esta venta");
                    Swal.fire({
                    type: 'error',
                    //title: 'Oops...',
                    text: 'Rellene todos los campos del detalle para esta venta',
                    })
                }
            }
        });
    }

    function editrow(index) {
        $("#contMod").hide();
        $("#subtotalMod").hide();
        $("#idMod").hide();
        $("#taxTypeModal").hide();
        // Obtener la fila
        var row = $("#row" + index);
        // Solo si la fila existe
        if(row) {

            // Buscar datos en la fila y asignar a campos del formulario:
            // Primera columna (0) tiene ID, segunda (1) tiene nombre, tercera (2) capacidad
            $("#contModal").val(index);
            $("#tax_typeModal").val(row.find("td:eq(2)").text());
            $("#product_idModal").val(row.find("td:eq(3)").text());
            $("#productModal").val(row.find("td:eq(4)").text());
            $("#quantityModal").val(row.find("td:eq(5)").text());
            $("#priceModal").val(row.find("td:eq(6)").text());
            $("#ivaModal").val(row.find("td:eq(7)").text());
            $("#subtotalModal").val(row.find("td:eq(8)").text());

            // Mostrar modal
            $('#editModal').modal('show');
        }
    }
    function updaterow() {

        // Buscar datos en la fila y asignar a campos del formulario:
        // Primera columna (0) tiene ID, segunda (1) tiene nombre, tercera (2) capacidad
        contedit = $("#contModal").val();
        taxType = $("#tax_typeModal").val();
        product_id = $("#product_idModal").val();
        product = $("#productModal").val();
        quantity = $("#quantityModal").val();
        price = $("#priceModal").val();
        tax_rate = $("#ivaModal").val();
        stold = $("#subtotalModal").val();
        $('#priceModal').prop("readonly", false)

        if(product_id !="" && quantity!="" && quantity>0 && price!="" && price>0){
            subtotal[cont]= parseFloat(quantity) * parseFloat(price);
            total = total+subtotal[cont];
            ivita = subtotal[cont]*tax_rate/100;
            total_tax=total_tax+ivita;
            if(taxType == 1){
                tax_iva += ivita;
            }
            if (stold > subtotal[cont]) {
                var row= '<tr class="selected" id="row'+cont+'"><td><button type="button" class="btn btn-danger btn-sm btndelete" onclick="deleterow('+cont+');"><i class="fas fa-trash"></i></button></td><td><button type="button" class="btn btn-warning btn-sm btnedit" onclick="editrow('+cont+');"><i class="far fa-edit"></i></button></td><td><input type="hidden" name="ttid[]"  value="'+taxType+'">'+taxType+'</td><td><input type="hidden" name="id[]"  value="'+product_id+'">'+product_id+'</td><td><input type="hidden" name="product_id[]" value="'+product_id+'">'+product+'</td>   <td><input type="hidden" name="quantity[]" value="'+quantity+'">'+quantity+'</td> <td><input type="hidden" name="price[]"  value="'+price+'">'+price+'</td> <td><input type="hidden" name="tax_rate[]"  value="'+tax_rate+'">'+tax_rate+'</td><td>'+subtotal[cont]+' </td></tr>';
                cont++;

                totals();
                assess();
                $('#details').append(row);
                deleterow(contedit);
                clearRetention();
                retentionUpdate();
                $('#editModal').modal('hide');
                //$('#product_id option:selected').remove();
            } else {
                    // alert("Rellene todos los campos del detalle de la venta, revise los datos del producto");
                    location.reload();
                    Swal.fire({
                    type: 'error',
                    //title: 'Oops...',
                    text: 'la nueva cantidad no puede ser Mayor',
                })
            }
        }else{
            // alert("Rellene todos los campos del detalle de la venta, revise los datos del producto");
            Swal.fire({
                type: 'error',
                //title: 'Oops...',
                text: 'Campo debe ser Mayor a 0',
            })
        }
    }

    $("#product_id").change(productValue);

    function productValue(){
        dataProduct = document.getElementById('product_id').value.split('_');
        $("#stock").val(dataProduct[1]);
        $("#price").val(dataProduct[2]);
        $("#tax_rate").val(dataProduct[3]);
        $("#tax_type").val(dataProduct[4]);

    }

    $(document).ready(function(){
        $("#add").click(function(){
            add();
        });
    });

    function add(){

        dataProduct = document.getElementById('product_id').value.split('_');
        product_id= dataProduct[0];
        product= $("#product_id option:selected").text();
        quantity= $("#quantity").val();
        price= $("#price").val();
        stock= $("#stock").val();
        tax_rate= $("#tax_rate").val();
        taxType = $("#tax_type").val();
        pv = $("#invoice_price").val();

        if(product_id !="" && quantity!="" && quantity>0 && price!="" && price>0 && tax_rate!= ""){
            subtotal[cont]= parseFloat(quantity) * parseFloat(price);
            total= total+subtotal[cont];
            ivita= subtotal[cont]*tax_rate/100;
            total_tax=total_tax+ivita;
            if(taxType == 1){
                tax_iva += ivita;
            }
            var row= '<tr class="selected" id="row'+cont+'"><td><button type="button" class="btn btn-danger btn-sm btndelete" onclick="deleterow('+cont+');"><i class="fas fa-trash"></i></button></td><td><button type="button" class="btn btn-warning btn-sm btnedit" onclick="editrow('+cont+');"><i class="far fa-edit"></i></button></td><td><input type="hidden" name="ttid[]"  value="'+taxType+'">'+taxType+'</td><td><input type="hidden" name="id[]"  value="'+product_id+'">'+product_id+'</td><td><input type="hidden" name="product_id[]" value="'+product_id+'">'+product+'</td>   <td><input type="hidden" name="quantity[]" value="'+quantity+'">'+quantity+'</td> <td><input type="hidden" name="price[]"  value="'+price+'">'+price+'</td> <td><input type="hidden" name="tax_rate[]"  value="'+tax_rate+'">'+tax_rate+'</td><td>'+subtotal[cont]+' </td></tr>';
            cont++;

            totals();
            retentionUpdate();
            assess();
            $('#details').append(row);
            $('#product_id option:selected').remove();
        }else{
            // alert("Rellene todos los campos del detalle de la venta, revise los datos del producto");
            Swal.fire({
            type: 'error',
            //title: 'Oops...',
            text: 'Los campos deben ser mayores a 0, o faltan campos por llenar',
            })
        }
    }


    function clean(){
        $("#product_id").val("");
        $("#quantityI").val("");
        $("#quantity").val("");
        $("#price").val("");
        $("#tax_rate").val("");
        $("#stock").val("");
    }

    function totals(){
        total_pay=total+total_tax;

        $("#total_html").html("$ " + total.toFixed(2));
        $("#total").val(total.toFixed(2));

        $("#total_tax_html").html("$ " + total_tax.toFixed(2));
        $("#total_tax").val(total_tax.toFixed(2));

        $("#total_pay_html").html("$ " + total_pay.toFixed(2));
        $("#total_pay").val(total_pay.toFixed(2));

        $("#total_ncinvoice").val(total.toFixed(2));
        $("#tax_iva").val(tax_iva);
    }
    function assess(){

        if(total>=0){

        $("#save").show();

        } else{

        $("#save").hide();
        }
    }

    function deleterow(index){
        /*
        var row = $("#row" + index);
        // Solo si la fila existe
        if(row) {

            // Buscar datos en la fila y asignar a campos del formulario:
            // Primera columna (0) tiene ID, segunda (1) tiene nombre, tercera (2) capacidad
            $("#tax_typeModal").val(row.find("td:eq(2)").text());
            $("#ivaModal").val(row.find("td:eq(7)").text());
            $("#subtotalModal").val(row.find("td:eq(8)").text());
        }
        taxType = $("#tax_typeModal").val();
        tax_rate = $("#ivaModal").val();
        subtotalindex = $("#subtotalModal").val();
        ivasubtotal = subtotalindex*tax_rate/100;
        total = total-subtotalindex;
        total_tax -= ivasubtotal;
        total_pay = total + total_tax;
        if(taxType == 1){
            tax_iva = tax_iva - ivasubtotal;
        }
        $("#total_html").html("$ " + total.toFixed(2));
        $("#total").val(total.toFixed(2));

        total_pay=total+total_tax;
        $("#total_tax_html").html("$ " + total_tax.toFixed(2));
        $("#total_tax").val(total_tax.toFixed(2));

        $("#total_pay_html").html("$ " + total_pay.toFixed(2));
        $("#total_pay").val(total_pay.toFixed(2));

        $("#total_ncinvoice").val(total.toFixed(2));
        $("#tax_iva").val(tax_iva);

        $("#row" + index).remove();
        assess();
        clearRetention();
        retentionUpdate();*/


        total = total-subtotal[index];
        total_tax= total*tax_rate/100;
        total_pay = total + total_tax;


        $("#total_html").html("$ " + total.toFixed(2));
        $("#total").val(total.toFixed(2));

        total_pay=total+total_tax;
        $("#total_tax_html").html("$ " + total_tax.toFixed(2));
        $("#total_tax").val(total_tax.toFixed(2));

        $("#total_pay_html").html("$ " + total_pay.toFixed(2));
        $("#total_pay").val(total_pay.toFixed(2));
        taxiva = subtotal[index]*tax_rate/100;
        tax_iva = tax_iva-taxiva;

        $("#total_ncinvoice").val(total.toFixed(2));
        $("#tax_iva").val(tax_iva);

        $("#row" + index).remove();
        assess();
        clearRetention();
        retentionUpdate();
    }



    function detailclear(){

        ncinvoice = {!! json_encode($invoiceProducts) !!};
        ncinvoice.forEach((value, i) => {
            if (value['quantity'] > 0) {
                deleterow(i);
                }
            });
        }
</script>
