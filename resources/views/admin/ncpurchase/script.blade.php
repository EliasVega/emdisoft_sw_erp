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
    let total_tax = 0;
    let tax_iva = 0;
    let tax_ivaedit = 0;
    $("#save").hide();
    $("#idProvider").hide();
    $("#addproduct").hide();
    $("#addquantity").hide();
    $("#addprice").hide();
    $("#added").hide();
    $("#cancelled").hide();
    $("#addtax_rate").hide();
    $("#addstock").hide();
    $("#purchase").hide();
    $("#addReverse").hide();
    $("#addResolution").hide();
    $("#addiva").hide();
    $("#taxType").hide();

    $(document).ready(function(){
        $("#discrepancy_id").change(function(){
            var discrepancy = $("#discrepancy_id").val();
            if(discrepancy == 7){
                $("#discrepancy").hide();
                cont = 0;
                total = 0;
                subtotal = [];
                total_tax = 0;
                $("#addproduct").show();
                $("#addquantity").show();
                $("#addprice").show();
                $("#added").show();
                $("#cancelled").show();
                //$("#addiva").show();
                //retentionLoad();
            } else if (discrepancy == 8) {
                $("#discrepancy").hide();
                cont = 0;
                total = 0;
                subtotal = [];
                total_tax = 0;
                $("#addproduct").hide();
                $("#addquantity").hide();
                $("#addprice").hide();
                $("#addtax_rate").hide();
                $("#addstock").hide();
                $("#added").hide();
                $("#addiva").hide();
                editing();
                retentionLoad();
                $('#quantityModal').prop("readonly", true);
                //$('#priceModal').prop("readonly", false);

            }
        });
    });

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

    function add(){

        dataProduct = document.getElementById('product_id').value.split('_');
        product_id= dataProduct[0];
        product= $("#product_id option:selected").text();
        quantity= $("#vquantity").val();
        price= $("#price").val();
        stock= $("#stock").val();
        tax_rate= $("#tax_rate").val();
        taxType = $("#tax_type").val();
        //pv = $("#purchase_price").val();
        if(product_id !="" && quantity!="" && quantity>0 && price!="" && price>0 && tax_rate!= ""){
                subtotal[cont]=quantity*price;
                total= total+subtotal[cont];
                ivita= subtotal[cont]*tax_rate/100;

                total_tax += ivita;
                if(taxType == 1){
                    tax_ivaedit += ivita;
                }
                var row= '<tr class="selected" id="row'+cont+'"><td><button type="button" class="btn btn-danger btn-sm btndelete" onclick="deleterow('+cont+');"><i class="fas fa-trash"></i></button></td><td><button type="button" class="btn btn-warning btn-sm btnedit" onclick="editrow('+cont+');"><i class="far fa-edit"></i></button></td><td><input type="hidden" name="ttid[]"  value="'+taxType+'">'+taxType+'</td><td><input type="hidden" name="id[]"  value="'+product_id+'">'+product_id+'</td> <td><input type="hidden" name="product_id[]" value="'+product_id+'">'+product+'</td>   <td><input type="hidden" name="quantity[]" value="'+quantity+'">'+quantity+'</td> <td><input type="hidden" name="price[]"  value="'+price+'">'+price+'</td><td><input type="hidden" name="tax_rate[]"  value="'+tax_rate+'">'+tax_rate+'</td><td>$'+subtotal[cont]+' </td></tr>';
                cont++;

                totals();
                retentionUpdate();
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

    function editing(){

        discrep = $("#discrepancy_id").val();
        ncpurchase = {!! json_encode($productPurchases) !!};
        ncpurchase.forEach((value, i) => {
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

                    var row= '<tr class="selected" id="row'+cont+'"><td><button type="button" class="btn btn-danger btn-sm btndelete" onclick="deleterow('+cont+');"><i class="fas fa-trash"></i></button></td><td><button type="button" class="btn btn-warning btn-sm btnedit" onclick="editrow('+cont+');"><i class="far fa-edit"></i></button></td><td><input type="hidden" name="ttid[]"  value="'+taxType+'">'+taxType+'</td><td><input type="hidden" name="id[]"  value="'+product_id+'">'+product_id+'</td><td><input type="hidden" name="product_id[]" value="'+product_id+'">'+product+'</td>   <td><input type="hidden" name="quantity[]" value="'+quantity+'">'+quantity+'</td> <td><input type="hidden" name="price[]"  value="'+price+'">'+price+'</td> <td><input type="hidden" name="tax_rate[]"  value="'+tax_rate+'">'+tax_rate+'</td><td>$'+subtotal[cont]+' </td></tr>';
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
        //id = $("#idModal").val();
        product_id = $("#product_idModal").val();
        product = $("#productModal").val();
        quantity = $("#quantityModal").val();
        price = $("#priceModal").val();
        tax_rate = $("#ivaModal").val();
        taxType = $("#tax_typeModal").val();

        $('#priceModal').prop("readonly", false)


        if(product_id !="" && quantity!="" && quantity>0 && price!="" && price>0){
            subtotal[cont]= parseFloat(quantity) * parseFloat(price);
            total= total+subtotal[cont];
            ivita= subtotal[cont]*tax_rate/100;
            total_tax=total_tax+ivita;

            total_tax += ivita;
            if(taxType == 1){
                tax_iva += ivita;
            }
            var row= '<tr class="selected" id="row'+cont+'"><td><button type="button" class="btn btn-danger btn-sm btndelete" onclick="deleterow('+cont+');"><i class="fas fa-trash"></i></button></td><td><button type="button" class="btn btn-warning btn-sm btnedit" onclick="editrow('+cont+');"><i class="far fa-edit"></i></button></td><td><input type="hidden" name="ttid[]"  value="'+taxType+'">'+taxType+'</td><td><input type="hidden" name="id[]"  value="'+product_id+'">'+product_id+'</td><td><input type="hidden" name="product_id[]" value="'+product_id+'">'+product+'</td>   <td><input type="hidden" name="quantity[]" value="'+quantity+'">'+quantity+'</td> <td><input type="hidden" name="price[]"  value="'+price+'">'+price+'</td> <td><input type="hidden" name="tax_rate[]"  value="'+tax_rate+'">'+tax_rate+'</td><td>$'+subtotal[cont]+' </td></tr>';
            cont++;

            totals();
            assess();
            $('#details').append(row);
            deleterow(contedit);
            clearRetention();
            retentionUpdate();
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



    function clean(){
        $("#product_id").val("");
        $("#vquantity").val("");
        $("#price").val("");
        $("#tax_rate").val("");
        $("#stock").val("");
    }

    function totals(){

        $("#total_html").html("$ " + total.toFixed(2));
        $("#total").val(total.toFixed(2));

        total_pay=total+total_tax;
        $("#total_tax_html").html("$ " + total_tax.toFixed(2));
        $("#total_tax").val(total_tax.toFixed(2));

        $("#total_pay_html").html("$ " + total_pay.toFixed(2));
        $("#total_pay").val(total_pay.toFixed(2));

        $("#total_ncpurchase").val(total.toFixed(2));
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

        $("#total_ncpurchase").val(total.toFixed(2));
        $("#tax_iva").val(tax_iva);

        $("#row" + index).remove();
        assess();
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
