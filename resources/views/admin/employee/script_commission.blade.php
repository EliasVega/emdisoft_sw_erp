<script>
    /*$(document).ready(function(){
        alert('estoy funcionando correctamanete empresa');
    });*/

    var cont = 0;
    var total = 0;
    var subtotal = [];

    //function editing(){
        commission = {!! json_encode($employeeInvoiceProduct) !!};
        commission.forEach((value, i) => {
            if (value['quantity'] > 0) {

                id = value['id'];
                datedoc = value['generation_date'];
                product = value['name']
                quantity = value['quantity'];
                price = value['price'];
                totalLine = value['subtotal'];
                commission = value['commission'];
                value_commission = value['value_commission'];
                if(quantity != "" && quantity > 0  && price != "" && price > 0){
                    subtotal[cont] = parseFloat(value_commission);
                    total = total + parseFloat(value_commission);

                    var row= '<tr class="selected" id="row'+cont+'"><td><button type="button" class="btn btn-danger btn-sm btndelete" onclick="deleterow('+cont+');"><i class="fas fa-trash"></i></button></td><td><input type="hidden" name="id[]"  value="'+id+'">'+id+'</td><td><input type="hidden" name="date_document[]"  value="'+datedoc+'">'+datedoc+'</td><td><input type="hidden" name="product[]" value="'+product+'">'+product+'</td>   <td><input type="hidden" name="quantity[]" value="'+quantity+'">'+quantity+'</td> <td><input type="hidden" name="price[]"  value="'+price+'">'+price+'</td> <td><input type="hidden" name="subtotal[]"  value="'+totalLine+'">'+totalLine+'</td><td><input type="hidden" name="percentage[]"  value="'+commission+'">'+commission+'</td><td><input type="hidden" name="value_commission[]"  value="'+value_commission+'">'+value_commission+'</td>';
                    cont++;

                    totaledit();
                    //assess();
                    $('#workLabors').append(row);

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
    //}*/
    function totaledit(){

        $("#total_pay_html").html("$ " + total.toFixed(2));
        $("#total_pay").val(total.toFixed(2));

        $("#balance").val(total);
        $("#pendient").val(total);
    }

    function deleterow(index){

        total = total - parseFloat(subtotal[index]);

        $("#total_pay_html").html("$ " + total.toFixed(2));
        $("#total_pay").val(total.toFixed(2));
        $("#row" + index).remove();

        $("#balance").val(total);
        $("#pendient").val(total);
    }
    /*
    function assess(){

        if(total>0){

            $("#save").show();
        } else{
            $("#save").hide();
        }
    }*/
</script>
