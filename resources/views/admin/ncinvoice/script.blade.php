<script>
    /*$(document).ready(function(){
        alert('estoy funcionando correctamante empresa');
    });*/

    jQuery(document).ready(function($){
        $(document).ready(function() {
            $('#discrepancy_id').select2({
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
            $('#product_id').select2({
                theme: "classic",
                width: "100%",
            });
        });
    });

    let cont=0;
    let total=0;
    let subtotal=[];
    let total_tax = 0;
    let tax_iva = 0;
    //let tax_ivaedit = 0;

    $("#formRetentions").hide();
    $("#doNotLook").hide();
    $("#addResolution").hide();
    $("#addReverse").hide();
    $("#save").hide();
    $("#addproduct").hide();
    $("#addquantity").hide();
    $("#addprice").hide();
    $("#added").hide();

    /*
    
    $("#idCustomer").hide();

    
    $("#addtax_rate").hide();
    $("#addstock").hide();
    $("#invoice").hide();
    
    $("#documentType").hide();
    
    $("#addTypeProduct").hide();*/


    $(document).ready(function(){
        $("#discrepancy_id").change(function(){
            var discrepancy = $("#discrepancy_id").val();
            if(discrepancy == 1){
                $("#discrepancy").hide();
                $('#priceModal').prop("readonly", true);
                cont=0;
                total=0;
                subtotal=[];
                total_tax = 0;
                $("#addReverse").show();

                editing();
                //retentionLoad();
            } else if (discrepancy == 2) {
                $("#discrepancy").hide();
                cont = 0;
                total = 0;
                subtotal = [];
                total_tax = 0;
                $("#addReverse").show();
                editing();
                //retentionLoad();
            } else if (discrepancy == 3) {
                $("#discrepancy").hide();
                $('#quantityModal').prop("readonly", true);
                $('#priceModal').prop("readonly", false);
                cont=0;
                total=0;
                subtotal=[];
                total_tax = 0;
                $("#addReverse").show();
                editing();
                //retentionLoad();
            } else if (discrepancy == 4) {
                $("#discrepancy").hide();
                $('#quantityModal').prop("readonly", true);
                $('#priceModal').prop("readonly", false);
                cont=0;
                total=0;
                subtotal=[];
                total_tax = 0;
                $("#addReverse").show();
                editing();
                //retentionLoad();
            }
        });
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
                    tr = parseFloat(tax_rate);
                    if (tr > 0) {
                        ivita = subtotal[cont]*tax_rate/100;
                    } else {
                        ivita = 0;
                    }
                    total_tax=total_tax+ivita;
                    if(taxType == 1){
                        tax_iva += ivita;
                    }

                    subcont = subtotal[cont] + parseFloat(ivita);
                    rowsList(cont, taxType, product_id, product, quantity, price, ivita, tax_rate, subcont);
                    cont++;

                    totals();
                    assess();
                    $('#details').append(row);
                    /*
                    $('#product_id option:selected').remove();
                    clean();*/

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

    jQuery(document).on("click", "#editrow", function () {
        editrow();
    });
    jQuery(document).on("click", "#updateNcinvoice", function () {
        updaterow();
    })

    function editrow(index) {
        $("#contMod").hide();
        $("#subtotalMod").hide();
        $("#idMod").hide();
        $("#taxTypeModal").hide();
        $("#ivaMod").hide();
        $("#productIdModal").hide();
        // Obtener la fila
        var row = $("#row" + index);
        // Solo si la fila existe
        if (row) {

            // Buscar datos en la fila y asignar a campos del formulario:
            // Primera columna (0) tiene ID, segunda (1) tiene nombre, tercera (2) capacidad
            $("#contModal").val(index);
            $("#tax_typeModal").val(row.find("td:eq(2)").text());
            $("#product_idModal").val(row.find("td:eq(3)").text());
            $("#productModal").val(row.find("td:eq(4)").text());
            $("#quantityModal").val(row.find("td:eq(5)").text());
            $("#priceModal").val(row.find("td:eq(6)").text());
            $("#ivaModal").val(row.find("td:eq(7)").text());
            $("#tax_rateModal").val(row.find("td:eq(8)").text());
            $("#subtotalModal").val(row.find("td:eq(9)").text());

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
        tax_rate = $("#tax_rateModal").val();
        stold = $("#subtotalModal").val();
        $('#priceModal').prop("readonly", false)

        if (product_id != "" && quantity != "" && quantity > 0 && price != "" && price > 0) {
            subtotal[cont] = parseFloat(quantity) * parseFloat(price);
            total = total + subtotal[cont];
            tr = parseFloat(tax_rate);
            if (tr > 0) {
                ivita = subtotal[cont] * tax_rate / 100;
            } else {
                ivita = 0;
            }
            total_tax = total_tax + ivita;
            if (taxType == 1) {
                tax_iva += ivita;
            }
            if (stold > subtotal[cont]) {
                subcont = subtotal[cont] + parseFloat(ivita);
                rowsList(cont, taxType, product_id, product, quantity, price, ivita, tax_rate, subcont);
                cont++;

                totals();
                assess();
                $('#details').append(row);
                deleterow(contedit);
                //clearRetention();
                //retentionUpdate();
                $('#editModal').modal('hide');
                //$('#product_id option:selected').remove();
            } else {
                // alert("Rellene todos los campos del detalle de la compra, revise los datos del producto");
                location.reload();
                Swal.fire({
                    type: 'error',
                    //title: 'Oops...',
                    text: 'la nueva cantidad no puede ser Mayor',
                })
            }
        } else {
            // alert("Rellene todos los campos del detalle de la compra, revise los datos del producto");
            Swal.fire({
                type: 'error',
                //title: 'Oops...',
                text: 'Campo debe ser Mayor a 0',
            })
        }
    }
    /*
    $("#product_id").change(productValue);

    function productValue(){
        dataProduct = document.getElementById('product_id').value.split('_');
        $("#stock").val(dataProduct[1]);
        $("#price").val(dataProduct[2]);
        $("#tax_rate").val(dataProduct[3]);
        $("#tax_type").val(dataProduct[4]);

    }*/
    /*
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
            var row= '<tr class="selected" id="row'+cont+'"><td><button type="button" class="btn btn-danger btn-xs btndelete" onclick="deleterow('+cont+');"><i class="fas fa-trash"></i></button></td><td><button type="button" class="btn btn-warning btn-xs btnedit" onclick="editrow('+cont+');"><i class="far fa-edit"></i></button></td><td><input type="hidden" name="ttid[]"  value="'+taxType+'">'+taxType+'</td><td><input type="hidden" name="id[]"  value="'+product_id+'">'+product_id+'</td><td><input type="hidden" name="product_id[]" value="'+product_id+'">'+product+'</td>   <td><input type="hidden" name="quantity[]" value="'+quantity+'">'+quantity+'</td> <td><input type="hidden" name="price[]"  value="'+price+'">'+price+'</td> <td><input type="hidden" name="tax_rate[]"  value="'+tax_rate+'">'+tax_rate+'</td><td>'+subtotal[cont]+' </td></tr>';
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
    }*/

    /*
    function clean(){
        $("#product_id").val("");
        $("#quantityI").val("");
        $("#quantity").val("");
        $("#price").val("");
        $("#tax_rate").val("");
        $("#stock").val("");
    }*/

    function totals(){
        total_pay=total+total_tax;

        $("#total_html").html("$ " + total.toFixed(2));
        $("#total").val(total.toFixed(2));

        $("#total_tax_html").html("$ " + total_tax.toFixed(2));
        $("#total_tax").val(total_tax.toFixed(2));

        $("#total_pay_html").html("$ " + total_pay.toFixed(2));
        $("#total_pay").val(total_pay.toFixed(2));

        //$("#total_ncinvoice").val(total.toFixed(2));
        //$("#tax_iva").val(tax_iva);
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

        //$("#total_ncinvoice").val(total.toFixed(2));
        //$("#tax_iva").val(tax_iva);

        $("#row" + index).remove();
        assess();
        //clearRetention();
        //retentionUpdate();
    }
    $(document).ready(function(){
        $("#addRetentions").click(function(){
            $("#formCard").hide();
            $("#formRetentions").show();
            $("#addProductId").hide();
            $("#qadd").hide();
            $("#padd").hide();
            $("#btnadd").hide();
        });
    });
    $(document).ready(function(){
        $("#goBack2").click(function(){
            $("#formCard").show();
            $("#formRetentions").hide();
            $("#addRetentions").hide();
        });
    });


    function detailclear(){

    ncinvoice = {!! json_encode($invoiceProducts) !!};
    ncinvoice.forEach((value, i) => {
        if (value['quantity'] > 0) {
            deleterow(i);
            }
        });
    }
    function disabledButton() {
        document.getElementById('registerForm').addEventListener('submit', function() {
            document.getElementById('register').setAttribute('disabled', 'true');
        });
    }

    function rowsList(cont, taxType, product_id, product, quantity, price, ivita, tax_rate, subcont) {
        row = '<tr class="selected" id="row'+cont+'"><td><button type="button" class="btn btn-danger btn-xs btndelete"onclick="deleterow('+cont+');"><i class="fas fa-trash"></i></button></td><td><button type="button" class="btnbtn-warning btn-xs btnedit" onclick="editrow('+cont+');"><i class="far fa-edit"></i></button></td><td><input type="hidden" name="ttid[]"  value="'+taxType+'">'+taxType+'</td><td><input type="hidden" name="product_id[]" value="'+product_id+'">'+product_id+'</td><td><input type="hidden" name="product[]" value="'+product+'">'+product+'</td><td><input type="hidden" name="quantity[]" value="'+quantity+'">'+parseFloat(quantity).toFixed(2)+'</td><td><input type="hidden" name="price[]" value="'+price+'">'+parseFloat(price).toFixed(2)+'</td><td><input type="hidden" name="ivaline[]" value="'+ivita+'">'+parseFloat(ivita).toFixed(2)+'</td><td><input type="hidden" name="tax_rate[]" value="'+tax_rate+'">'+parseFloat(tax_rate).toFixed(2)+'</td><td>'+parseFloat(subcont).toFixed(2)+'</td></tr>';
    }
</script>
