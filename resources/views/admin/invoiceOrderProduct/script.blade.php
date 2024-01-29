<script>
    /*$(document).ready(function(){
            alert('estoy funcionando correctamanete empresa');
        });*/
    jQuery(document).ready(function($){
        $(document).ready(function() {
            $('#branch_id').select2({
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
            $('#customer_id').select2({
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
    //form invoice
    $("#idPro").hide();
    $("#percent").hide();
    $("#taxType").hide();
    $("#resolution").hide();
    $("#documentType").hide();
    $("#uvt5").hide();
    $("#posActive").hide();
    $("#save").hide();
    $("#posavtivity").hide();
    //$("#addProductId").hide();
    $("#barcodeId").hide();
    //$("#productBarcode").hide();


    $(document).ready(function(){
        typeInvoice = $("#pos_active").val();
        if (typeInvoice == 'off') {
            $("#resolution").show();
            $("#addFe").hide();
            $(".fe_true").val(1);
            $('#resolution_id').prop("required", true)
        }

        let barcodestart = $(("#switch_barcode")).prop("checked");// == true ? 1 : 0;
        if (barcodestart == true) {
            $("#addProductId").hide();
            $("#codeBarcode").show();
            $("#productBarcode").show();
        } else if(barcodestart == false){
            $("#codeBarcode").hide();
            $("#productBarcode").hide();
            $("#addProductId").show();
        }
    });

    function totals(){
        var total_pay = total + total_tax;

        $("#total_html").html("$ " + total.toFixed(2));
        $("#total").val(total.toFixed(2));

        $("#total_tax_html").html("$ " + total_tax.toFixed(2));
        $("#total_tax").val(total_tax.toFixed(2));

        $("#total_pay_html").html("$ " + total_pay.toFixed(2));
        $("#total_pay").val(total_pay.toFixed(2));

        $("#balance").val(total_pay.toFixed(2));
        $("#pendient").val(total_pay.toFixed(2));
        $("#total_invoice").val(total.toFixed(2));
        $("#tax_iva").val(tax_iva);
        pos();
    }

    function pos(){
        if (pos_on == 'on') {
            if (total > uvt) {
                $("#resolution").show();
                $(".fe_true").val(1);
                $("#addFe").hide();
                //$("#resolution_id").val(1);
                $('#resolution_id').prop("required", true)
            } else {
                $("#resolution").hide();
                $("#addFe").show();
                $(".fe_true").val(2);
                //$("#resolution_id").val(1);
                $('#resolution_id').prop("required", false)
            }
        }
    }

    $(document).ready(function(){
        $("#fe_on").click(function(){
            $(".fe_true").val(1);
            $("#resolution").show();
            $("#addFe").hide();
            $('#resolution_id').prop("required", true)
            $("#addPercentage").show();
        });
    });
    $(document).ready(function(){
        $("#fe_off").click(function(){
            $(".fe_true").val(2);
            $("#resolution").hide();
            $("#resolution_id").val(4);
            $('#resolution_id').prop("required", false)
        });
    });
    function assess(){

        if(total>0){

        $("#save").show();
        } else{
            $("#save").hide();
        }
    }
    function deleterow(index){
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

        if (pos_on == 'on') {
            pos();
        }

        assess();
    }

    //function editing(){
        iop = {!! json_encode($invoiceOrderProducts) !!};
        iop.forEach((value, i) => {

            if (value['quantity'] > 0) {
                id = value['id'];
                product_id= value['idP'];
                product= value['name'];
                quantity= value['quantity'];
                price= value['price'];
                tax_rate= value['tax_rate'];
                employee_id = value['employee']

                if(product_id !="" && quantity!="" && quantity>0  && price!="" && price>0){
                    subtotal[cont]= parseFloat(quantity) * parseFloat(price);
                    total= total+subtotal[cont];
                    ivita= subtotal[cont]*tax_rate/100;
                    tax_cont[cont] = total_tax+ivita;
                    total_tax=total_tax+ivita;

                    var row= '<tr class="selected" id="row'+cont+'"><td><input type="hidden" name="employee_id[]"  value="'+employee_id+'">'+employee_id+'</td><td><input type="hidden" name="product_id[]"  value="'+product_id+'">'+product_id+'</td><td><input type="hidden" name="product[]" value="'+product+'">'+product+'</td>   <td><input type="hidden" name="quantity[]" value="'+quantity+'">'+quantity+'</td> <td><input type="hidden" name="price[]"  value="'+price+'">'+price+'</td> <td><input type="hidden" name="tax_rate[]"  value="'+tax_rate+'">'+tax_rate+'</td><td> $'+parseFloat(subtotal[cont]).toFixed(2)+'</td></tr>';
                    cont++;

                    totals();
                    assess();
                    $('#details').append(row);

                    $('#product_id option:selected').remove();
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
</script>
