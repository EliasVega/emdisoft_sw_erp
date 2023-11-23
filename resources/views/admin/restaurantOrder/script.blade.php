<script>
    /*$(document).ready(function(){
            alert('estoy funcionando correctamanete empresa');
        });*/

    jQuery(document).ready(function($){
        $(document).ready(function() {
            $('#product_id').select2({
                theme: "classic",
                width: "100%",
            });
        });
    });
    var cont=0;
    total=0;
    subtotal=[];
    total_tax=0;
    tax_ratecont = [];
    //form invoice
    //$("#addProduct").hide();
    $("#addSuggestedPrice").hide();
    $("#addInc").hide();
    $("#editrm").hide();
    $("#homeOrder").hide();

    $("#product_id").change(productValue);

    function productValue(){
        dataProduct = document.getElementById('product_id').value.split('_');
        $("#idProduct").val(dataProduct[0]);
        $("#sale_price").val(dataProduct[1]);
        $("#suggested_price").val(dataProduct[1]);
        $("#tax_rate").val(dataProduct[2]);

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
        price= $("#sale_price").val();
        tax_rate= $("#tax_rate").val();
        $("#referency").val(cont);
        if(product_id !="" && quantity!="" && quantity>0  && price!="" && tax_rate!=""){
            subtotal[cont]= parseFloat(quantity) * parseFloat(price);
            total= total+subtotal[cont];
            ivita= subtotal[cont]*tax_rate/100;
            total_tax=total_tax+ivita;
            tax_ratecont[cont]=tax_rate

            var row= '<tr class="selected" id="row'+cont+'"><td><button type="button" class="btn btn-danger btn-sm" onclick="deletemenu('+cont+');"><i class="fa fa-times"></i></button></td><td><input type="hidden" name="ref[]" value="'+cont+'">'+cont+'</td><td><input type="hidden" name="product_id[]" value="'+product_id+'">'+product_id+'</td><td><input type="hidden" name="product[]" value="'+product+'">'+product+'</td> <td><input type="hidden" id="quantity" name="quantity[]" value="'+quantity+'">'+quantity+'</td> <td><input type="hidden" id="price" name="price[]" value="'+parseFloat(price).toFixed(2)+'">'+price+'</td> td> <td><input type="hidden" name="tax_rate[]" value="'+tax_rate+'">'+tax_rate+'</td>  <td> $'+parseFloat(subtotal[cont]).toFixed(2)+'</td></tr>';
            cont++;

            totals();
            assess();
            $('#details').append(row);
            //$('#product_id option:selected').remove();
            clean();
        }else{
            //alert("Rellene todos los campos del detalle de la venta");
            Swal.fire({
            type: 'error',
            //title: 'Oops...',
            text: 'Rellene todos los campos del detalle de la venta',
            })
        }
    }
    function clean(){
        //$("#product_id").val("");
        $('#product_id').val(null).trigger('change');
        $("#quantity").val("");
        $("#sale_price").val("");
    }
    function totals(){

        $("#total_html").html("$ " + total.toFixed(2));
        $("#total").val(total.toFixed(2));

        total_pay=total+total_tax;
        $("#total_tax_html").html("$ " + total_tax.toFixed(2));
        $("#total_tax").val(total_tax.toFixed(2));

        $("#total_pay_html").html("$ " + total_pay.toFixed(2));
        $("#total_pay").val(total_pay.toFixed(2));

        $("#balance").val(total_pay.toFixed(2));
    }
    function assess(){

        if(total>0){

        $("#save").show();

        } else{
            $("#save").hide();
        }
    }
    function deletemenu(index){

        total = total-subtotal[index];
        tax = subtotal[index]*tax_ratecont[index]/100;
        total_tax= total_tax - tax;
        total_pay = total + total_tax;

        $("#total_html").html("$ " + total.toFixed(2));
        $("#total").val(total.toFixed(2));

        $("#total_tax_html").html("$ " + total_tax.toFixed(2));
        $("#total_tax").val(total_tax.toFixed(2));

        $("#total_pay_html").html("$ " + total_pay.toFixed(2));
        $("#total_pay").val(total_pay.toFixed(2));

        $("#fila" + index).remove();
        assess();
    }
    $(document).ready(function(){
        $("#checkbox1").click(function(){
            $("#createTable").show();
            $("#homeOrder").hide();
        });
    });

    $(document).ready(function(){
        $("#checkbox2").click(function(){
            $("#homeOrder").show();
            $("#createTable").hide();
            $("#name").val('X');
            $("#address").val('X');
            $("#phone").val('X');
        });
    });

    $(document).ready(function(){
        $("#checkbox3").click(function(){
            $("#homeOrder").show();
            $("#createTable").hide();
            $("#name").val('Rappi');
            $("#address").val('Rappi');
            $("#phone").val('Rappi');
        });
    });

    $("input:checkbox").on('click', function() {
        // in the handler, 'this' refers to the box clicked on
        var $box = $(this);
        if ($box.is(":checked")) {
            var group = "input:checkbox[name='" + $box.attr("name") + "']";
            $(group).prop("checked", false);
            $box.prop("checked", true);
        } else {
            $box.prop("checked", false);
        }
    });
</script>
