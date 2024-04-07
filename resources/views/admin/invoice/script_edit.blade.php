<script>
    /*$(document).ready(function(){
            alert('estoy funcionando correctamanete empresa');
        });*/
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
    var uvt = '';
    var pos_on = '';

    //function editing(){
        ip = {!! json_encode($invoiceProducts) !!};
        ip.forEach((value, i) => {

            if (value['quantity'] > 0) {
                id = value['id'];
                employee_id = value['employee'];
                employeeName = value['employeeName'];
                product_id= value['idP'];
                product= value['name'];
                quantity= value['quantity'];
                price= value['price'];
                tax_rate= value['tax_rate'];
                if(product_id !="" && quantity!="" && quantity>0  && price!="" && price>0){
                    subtotal[cont]= parseFloat(quantity) * parseFloat(price);
                    total= total+subtotal[cont];
                    ivita= subtotal[cont]*tax_rate/100;
                    tax_cont[cont] = total_tax+ivita;
                    total_tax=total_tax+ivita;

                    var row= '<tr class="selected" id="row'+cont+'"><td><button type="button" class="btn btn-warning btn-xs btnedit" onclick="editRowEdit('+cont+');"><i class="far fa-edit"></i></button></td><td><input type="hidden" name="employee_id[]"  value="'+employee_id+'">'+employee_id+'</td><td><input type="hidden" name="employee[]"  value="'+employeeName+'">'+employeeName+'</td><td><input type="hidden" name="product_id[]"  value="'+product_id+'">'+product_id+'</td><td><input type="hidden" name="product[]" value="'+product+'">'+product+'</td>   <td><input type="hidden" name="quantity[]" value="'+quantity+'">'+quantity+'</td> <td><input type="hidden" name="price[]"  value="'+price+'">'+price+'</td> <td><input type="hidden" name="tax_rate[]"  value="'+tax_rate+'">'+tax_rate+'</td><td> $'+parseFloat(subtotal[cont]).toFixed(2)+'</td></tr>';
                    cont++;

                    totals();
                    $('#details').append(row);
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
    //}
    function totals(){
        var total_pay = total + total_tax;

        $("#total_html").html("$ " + total.toFixed(2));
        $("#total").val(total.toFixed(2));

        $("#total_tax_html").html("$ " + total_tax.toFixed(2));
        $("#total_tax").val(total_tax.toFixed(2));

        $("#total_pay_html").html("$ " + total_pay.toFixed(2));
        $("#total_pay").val(total_pay.toFixed(2));
    }

    function editRowEdit(index) {
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
            $("#employee_idModal").val(row.find("td:eq(1)").text());
            $("#employeeModal").val(row.find("td:eq(2)").text());
            $("#product_idModal").val(row.find("td:eq(3)").text());
            $("#productModal").val(row.find("td:eq(4)").text());
            $("#quantityModal").val(row.find("td:eq(5)").text());
            $("#priceModal").val(row.find("td:eq(6)").text());
            $("#taxModal").val(row.find("td:eq(7)").text());
            $("#subtotalModal").val(row.find("td:eq(8)").text());
            // Mostrar modal
            $('#modalEdit').modal('show');
        }
        }

        jQuery(document).on("click", "#updateEmployee", function () {
            updateRowEdit();
        });

    function updateRowEdit() {

        // Buscar datos en la row y asignar a campos del formulario:
        // Primera columna (0) tiene ID, segunda (1) tiene nombre, tercera (2) capacidad
        contedit = $("#contModal").val();
        //id = $("#idModal").val();
        employee_id = $("#employee_idModal").val();
        employeeName= $("#employee_idModal option:selected").text();
        product_id = $("#product_idModal").val();
        product = $("#productModal").val();
        quantity = $("#quantityModal").val();
        price = $("#priceModal").val();
        tax_rate = $("#taxModal").val();
        if(product_id !="" && quantity!="" && quantity>0 && price!="" && price>0){
            subtotal[cont]= parseFloat(quantity) * parseFloat(price);
            total = total+subtotal[cont];
            ivita= subtotal[cont]*tax_rate/100;
            tax_cont[cont] = ivita;
            total_tax = total_tax+ivita;

            var row= '<tr class="selected" id="row'+cont+'"><td><button type="button" class="btn btn-warning btn-xs btnedit" onclick="editRowEdit('+cont+');"><i class="far fa-edit"></i></button></td><td><input type="hidden" name="employee_id[]"  value="'+employee_id+'">'+employee_id+'</td><td><input type="hidden" name="employee[]"  value="'+employeeName+'">'+employeeName+'</td><td><input type="hidden" name="product_id[]"  value="'+product_id+'">'+product_id+'</td><td><input type="hidden" name="product[]" value="'+product+'">'+product+'</td>   <td><input type="hidden" name="quantity[]" value="'+quantity+'">'+quantity+'</td> <td><input type="hidden" name="price[]"  value="'+price+'">'+price+'</td> <td><input type="hidden" name="tax_rate[]"  value="'+tax_rate+'">'+tax_rate+'</td><td> $'+parseFloat(subtotal[cont]).toFixed(2)+'</td></tr>';
            cont++;

            deleterow(contedit);
            $('#details').append(row);
            $('#modalEdit').modal('hide');
            swal.fire({
                icon: 'success',
                text: product + '--' + 'Editado correctamente',
                showConfirmButton: false,
                timer: 3000 // es ms (mili-segundos)
            });
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
    function deleterow(index){
        $("#row" + index).remove();
    }
</script>
