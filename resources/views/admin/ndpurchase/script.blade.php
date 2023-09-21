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
    jQuery(document).on("click", "#updatePurchase", function () {
        updaterow();
    })

        /*
    $(document).ready(function(){
        $("#updatePurchase").click(function(){
            editrow();
        });
    });*/

    let cont=0;
    let total=0;
    let subtotal=[];
    let total_iva = 0;
    $("#save").hide();
    $("#idProvider").hide();
    $("#addproduct").hide();
    $("#addquantity").hide();
    $("#addprice").hide();
    $("#added").hide();
    $("#addtax_rate").hide();
    $("#addstock").hide();
    $("#purchase").hide();
    $("#addReverse").hide();

    $("#product_id").change(productValue);

    function productValue(){

        dataProduct = document.getElementById('product_id').value.split('_');
        $("#stock").val(dataProduct[1]);
        $("#price").val(dataProduct[2]);
        $("#purchase_price").val(dataProduct[2]);
        $("#tax_rate").val(dataProduct[3]);
        pricep = dataProduct[1];
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
        pv = $("#purchase_price").val();


        if(product_id !="" && quantity!="" && quantity>0 && price!="" && price>0 && tax_rate!= ""){
                subtotal[cont]=quantity*price;
                total= total+subtotal[cont];
                ivita= subtotal[cont]*tax_rate/100;
                total_iva=total_iva+ivita;
                var row= '<tr class="selected" id="row'+cont+'"><td><button type="button" class="btn btn-danger btn-sm btndelete" onclick="deleterow('+cont+');"><i class="fas fa-trash"></i></button></td><td><button type="button" class="btn btn-warning btn-sm btnedit" onclick="editrow('+cont+');"><i class="far fa-edit"></i></button></td><td><input type="hidden" name="id[]"  value="'+product_id+'">'+product_id+'</td> <td><input type="hidden" name="product_id[]" value="'+product_id+'">'+product+'</td>   <td><input type="hidden" name="quantity[]" value="'+quantity+'">'+quantity+'</td> <td><input type="hidden" name="price[]"  value="'+price+'">'+price+'</td><td><input type="hidden" name="tax_rate[]"  value="'+tax_rate+'">'+tax_rate+'</td><td>$'+subtotal[cont]+' </td></tr>';
                cont++;

                totals();
                assess();
                $('#details').append(row);
                $('#product_id option:selected').remove();
        }else{
            // alert("Rellene todos los campos del detalle de la compra, revise los datos del producto");
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

        $("#total_html").html("$ " + total.toFixed(2));
        $("#total").val(total.toFixed(2));

        total_pay=total+total_iva;
        $("#total_iva_html").html("$ " + total_iva.toFixed(2));
        $("#total_iva").val(total_iva.toFixed(2));

        $("#total_pay_html").html("$ " + total_pay.toFixed(2));
        $("#total_pay").val(total_pay.toFixed(2));

    }
    function assess(){

        if(total>=0){

        $("#save").show();

        } else{

        $("#save").hide();
        }
    }

    function deleterow(index){

        total = total-subtotal[index];
        total_iva= total*tax_rate/100;
        total_pay = total + total_iva;

        $("#total_html").html("$ " + total.toFixed(2));
        $("#total").val(total.toFixed(2));

        total_pay=total+total_iva;
        $("#total_iva_html").html("$ " + total_iva.toFixed(2));
        $("#total_iva").val(total_iva.toFixed(2));

        $("#total_pay_html").html("$ " + total_pay.toFixed(2));
        $("#total_pay").val(total_pay.toFixed(2));

        $("#row" + index).remove();
        assess();
    }

    function editrow(index) {
        $("#contMod").hide();
        $("#subtotalMod").hide();
        $("#idMod").hide();
        // Obtener la fila
        var row = $("#row" + index);
        // Solo si la fila existe
        if(row) {

            // Buscar datos en la fila y asignar a campos del formulario:
            // Primera columna (0) tiene ID, segunda (1) tiene nombre, tercera (2) capacidad
            $("#contModal").val(index);
            $("#product_idModal").val(row.find("td:eq(2)").text());
            $("#productModal").val(row.find("td:eq(3)").text());
            $("#quantityModal").val(row.find("td:eq(4)").text());
            $("#priceModal").val(row.find("td:eq(5)").text());
            $("#ivaModal").val(row.find("td:eq(6)").text());
            $("#subtotalModal").val(row.find("td:eq(7)").text());

            // Mostrar modal
            $('#editModal').modal('show');
        }
    }
    function updaterow() {

        // Buscar datos en la fila y asignar a campos del formulario:
        // Primera columna (0) tiene ID, segunda (1) tiene nombre, tercera (2) capacidad
        contedit = $("#contModal").val();
        //id = $("#idModal").val();
        product_id = $("#product_idModal").val();
        product = $("#productModal").val();
        quantity = $("#quantityModal").val();
        price = $("#priceModal").val();
        tax_rate = $("#ivaModal").val();

        $('#priceModal').prop("readonly", true)


        if(product_id !="" && quantity!="" && quantity>0 && price!="" && price>0){
            subtotal[cont]= parseFloat(quantity) * parseFloat(price);
            total= total+subtotal[cont];
            ivita= subtotal[cont]*tax_rate/100;
            total_iva=total_iva+ivita;

            var row= '<tr class="selected" id="row'+cont+'"><td><button type="button" class="btn btn-danger btn-sm btndelete" onclick="deleterow('+cont+');"><i class="fas fa-trash"></i></button></td><td><button type="button" class="btn btn-warning btn-sm btnedit" onclick="editrow('+cont+');"><i class="far fa-edit"></i></button></td><td><input type="hidden" name="id[]"  value="'+product_id+'">'+product_id+'</td><td><input type="hidden" name="product_id[]" value="'+product_id+'">'+product+'</td>   <td><input type="hidden" name="quantity[]" value="'+quantity+'">'+quantity+'</td> <td><input type="hidden" name="price[]"  value="'+price+'">'+price+'</td> <td><input type="hidden" name="tax_rate[]"  value="'+tax_rate+'">'+tax_rate+'</td><td>$'+subtotal[cont]+' </td></tr>';
            cont++;

            totals();
            assess();
            $('#details').append(row);
            deleterow(contedit);
            $('#editModal').modal('hide');
            //$('#product_id option:selected').remove();
        }else{
            // alert("Rellene todos los campos del detalle de la compra, revise los datos del producto");
            Swal.fire({
                type: 'error',
                //title: 'Oops...',
                text: 'Campo debe ser Mayor a 0',
            })
        }
    }

    $(document).ready(function(){
        $("#discrepancy_id").change(function(){
            var discrepancy = $("#discrepancy_id").val();
            if(discrepancy == 1){
                $("#discrepancy").hide();
                $('#priceModal').prop("readonly", true);
                cont=0;
                total=0;
                subtotal=[];
                total_iva = 0;

                $("#addproduct").hide();
                $("#addquantity").hide();
                $("#addprice").hide();
                $("#addtax_rate").hide();
                $("#addstock").hide();
                $("#added").hide();
                $("#addReverse").hide();
                editing();
            } else if (discrepancy == 2) {
                $("#discrepancy").hide();
                cont = 0;
                total = 0;
                subtotal = [];
                total_iva = 0;
                $("#addproduct").hide();
                $("#addquantity").hide();
                $("#addprice").hide();
                $("#added").hide();
                $("#cancelled").hide();
                $("#updatePurchase").hide();
                $("#addReverse").show();
                editing();
            } else if (discrepancy == 3) {
                $("#discrepancy").hide();
                $('#quantityModal').prop("readonly", true);
                cont=0;
                total=0;
                subtotal=[];
                total_iva = 0;

                $("#addproduct").hide();
                $("#addquantity").hide();
                $("#addprice").hide();
                $("#addtax_rate").hide();
                $("#addstock").hide();
                $("#added").hide();
                editing();
            } else if (discrepancy == 4) {
                $("#discrepancy").hide();
                $('#quantityModal').prop("readonly", true);
                cont=0;
                total=0;
                subtotal=[];
                total_iva = 0;

                $("#addproduct").hide();
                $("#addquantity").hide();
                $("#addprice").hide();
                $("#addtax_rate").hide();
                $("#addstock").hide();
                $("#added").hide();
                editing();
            }
        });
    });
    function editing(){

        discrep = $("#discrepancy_id").val();
        ndpurchase = {!! json_encode($productPurchases) !!};
        ndpurchase.forEach((value, i) => {
            if (value['quantity'] > 0) {

                id = value['id'];
                product_id= value['idP'];
                product= value['name'];
                quantity= value['quantity'];
                price= value['price'];
                stock= value['stock'];
                tax_rate= value['tax_rate'];

                if(product_id !="" && quantity!="" && quantity>0  && price!="" && price>0){
                    subtotal[cont]= parseFloat(quantity) * parseFloat(price);
                    total= total+subtotal[cont];
                    ivita= subtotal[cont]*tax_rate/100;
                    total_iva=total_iva+ivita;

                    var row= '<tr class="selected" id="row'+cont+'"><td><button type="button" class="btn btn-danger btn-sm btndelete" onclick="deleterow('+cont+');"><i class="fas fa-trash"></i></button></td><td><button type="button" class="btn btn-warning btn-sm btnedit" onclick="editrow('+cont+');"><i class="far fa-edit"></i></button></td><td><input type="hidden" name="id[]"  value="'+product_id+'">'+product_id+'</td><td><input type="hidden" name="product_id[]" value="'+product_id+'">'+product+'</td>   <td><input type="hidden" name="quantity[]" value="'+quantity+'">'+quantity+'</td> <td><input type="hidden" name="price[]"  value="'+price+'">'+price+'</td> <td><input type="hidden" name="tax_rate[]"  value="'+tax_rate+'">'+tax_rate+'</td><td>$'+subtotal[cont]+' </td></tr>';
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
                    //alert("Rellene todos los campos del detalle para esta compra");
                    Swal.fire({
                    type: 'error',
                    //title: 'Oops...',
                    text: 'Rellene todos los campos del detalle para esta compra',
                    })
                }
            }
        });
    }

    function detailclear(){

        ndpurchase = {!! json_encode($productPurchases) !!};
        ndpurchase.forEach((value, i) => {
            if (value['quantity'] > 0) {
                deleterow(i);
        }
    });
}
</script>
