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
            $('#customer_home_id').select2({
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
    refProduct = [];
    //form invoice
    //$("#addProduct").hide();
    $("#addSuggestedPrice").hide();
    $("#addInc").hide();
    $("#editrm").hide();
    $("#homeOrder").hide();
    $("#invoicenegative").hide();
    $("#save").hide();
    $("#customer_home_id").change(customerValue);

    function customerValue(){
        dataCustomer = document.getElementById('customer_home_id').value.split('_');
        $("#name").val(dataCustomer[1]);
        $("#address").val(dataCustomer[2]);
        $("#phone").val(dataCustomer[3]);
    }

    $("#product_id").change(productValue);

    function productValue(){
        dataProduct = document.getElementById('product_id').value.split('_');
        $("#idProduct").val(dataProduct[0]);
        $("#price").val(dataProduct[1]);
        $("#tax_rate").val(dataProduct[2]);
        $("#suggested_price").val(dataProduct[1]);
    }
    $(document).ready(function(){
        $("#add").click(function(){
            add();
            insertrm();
        });
    });
    function add(){
        dataProduct = document.getElementById('product_id').value.split('_');
        product_id = dataProduct[0];
        product= $("#product_id option:selected").text();
        quantity= $("#quantityadd").val();
        price= $("#price").val();
        tax_rate= $("#tax_rate").val();
        pwx = $("#pwx").val();
        if (pwx == 'on') {
            taxRate = parseFloat(tax_rate) + 100;
            price = (parseFloat(price) / parseFloat(taxRate)) * 100;
        }
        $("#referency").val(cont);
        if(product_id !="" && quantity!="" && quantity>0  && price!="" && tax_rate!=""){
            subtotal[cont]= parseFloat(quantity) * parseFloat(price);
            total= total+subtotal[cont];
            tr = parseFloat(tax_rate);
            if (tr > 0) {
                ivita = subtotal[cont]*tax_rate/100;
            } else {
                ivita = 0;
            }
            total_tax=total_tax+ivita;
            tax_ratecont[cont]=tax_rate;
            refProduct[cont] = cont;

            var row= '<tr class="selected" id="row'+cont+'"><td><button type="button" class="btn btn-danger btn-sm" onclick="deleteProduct('+cont+');"><i class="fa fa-times"></i></button></td><td><input type="hidden" name="ref[]" value="'+cont+'">'+cont+'</td><td><input type="hidden" name="product_id[]" value="'+product_id+'">'+product_id+'</td><td><input type="hidden" name="product[]" value="'+product+'">'+product+'</td> <td><input type="hidden" id="quantity" name="quantity[]" value="'+quantity+'">'+quantity+'</td> <td><input type="hidden" id="price" name="price[]" value="'+parseFloat(price).toFixed(3)+'">'+parseFloat(price).toFixed(2)+'</td><td><input type="hidden" id="price" name="ivaline[]" value="'+parseFloat(ivita).toFixed(3)+'">'+parseFloat(ivita).toFixed(2)+'</td><td><input type="hidden" name="tax_rate[]" value="'+tax_rate+'">'+tax_rate+'</td>  <td> $'+parseFloat(subtotal[cont]).toFixed(2)+'</td></tr>';
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
        $("#quantityadd").val(1);
        $("#price").val("");
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
        
        if(total > 0){
            $("#save").show();
        } else{
            $("#save").hide();
        }
    }
    function deleteProduct(index){

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
        referencyProduct = refProduct[index];

        deleteRawmaterials(referencyProduct)
        $("#row" + index).remove();
        assess();
    }

    $(document).ready(function(){
        $("#checkbox1").click(function(){
            $("#createTable").show();
            $("#homeOrder").hide();
            $("#addCustomer").show();
        });
    });

    $(document).ready(function(){
        $("#checkbox2").click(function(){
            $("#homeOrder").show();
            $("#createTable").hide();
            $("#name").val('X');
            $("#address").val('X');
            $("#phone").val('X');
            $("#addCustomer").hide();
        });
    });

    $(document).ready(function(){
        $("#checkbox3").click(function(){
            $("#homeOrder").show();
            $("#createTable").hide();
            $("#name").val('Rappi');
            $("#address").val('Rappi');
            $("#phone").val('Rappi');
            $("#addCustomer").hide();
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
    function disabledButton() {
        document.getElementById('registerForm').addEventListener('submit', function() {
            document.getElementById('register').setAttribute('disabled', 'true');
        });
    }
</script>
