<script>
    /*$(document).ready(function(){
            alert('estoy funcionando correctamanete empresa');
        });*/

        //Selecciona el municipio de acuerdo al departamento

    jQuery(document).ready(function($){
        $(document).ready(function() {
            $('#payment_form_id').select2({
                theme: "classic",
                width: "100%",
            });
        });
    });
    var pendient = 0;

    //$("#valuePay").hide();
    $("#types").hide();
    $("#pendadd").hide();
    $("#methodPay").hide();
    $("#totalPayValue").hide();
    $("#payment_method_id").val(2);

    /*
    $("#percentage").val(0);
    */

    $(document).ready(function(){
        $("#payment_form_id").change(function(){
            form = $("#payment_form_id").val();
            if(form == 1){
                $("#returnedBalance").show();
                $("#valuePay").show();
                $("#payment_method_id").val(10);
            }else{
                $("#returnedBalance").hide();
                $("#valuePay").hide();
                $("#payment_method_id").val(1);
            }
        });
    });

    $(document).ready(function(){
        $("#pay").keyup(function(){
            $("#pay").val();
            $("#returned").val();
            paymentor();
        });
    });

    function paymentor(){
        ttp = parseFloat($("#pendient").val())
        abn = parseFloat($("#pay").val())
        balancey = ttp - abn;
        $("#returned").val(balancey);
    }

    var contpay=0;
    totalpay=0;
    $(document).ready(function(){
        $("#paying").click(function(){
            paying();
        });
    });
    function paying(){

        payment_method_id = $("#payment_method_id").val();
        payment_method = $("#payment_method_id option:selected").text();
        bank_id = $("#bank_id").val();
        bank = $("#bank_id option:selected").text();
        card_id = $("#card_id").val();
        card = $("#card_id option:selected").text();
        pay = $("#pay").val();
        transaction = $("#transaction").val();
        pendient = parseFloat($("#pendient").val());

        if(payment_method_id !="" && bank_id!="" && card_id!=""  && pay!="" && pay>0 && transaction!=""){
            totalpay = parseFloat(totalpay) + parseFloat(pay);
            rbalance = parseFloat(pendient) - parseFloat(pay);
            paycont[contpay] = pay;

            if (pendient >= pay) {
                var rowpay= '<tr class="selected" id="rowpay'+contpay+'"><td><button type="button" class="btn btn-danger btn-sm" onclick="deletepay('+contpay+');"><i class="fa fa-times"></i></button></td> <td><input type="hidden" name="payment_method_id[]" value="'+payment_method_id+'">'+payment_method+'</td> <td><input type="hidden" name="card_id[]" value="'+card_id+'">'+card+'</td> <td><input type="hidden" name="bank_id[]" value="'+bank_id+'">'+bank+'</td> <td><input type="hidden" name="transaction[]" value="'+transaction+'">'+transaction+'</td> <td><input type="hidden" name="pay[]" value="'+pay+'">'+pay+'</td>  </tr>';
                contpay++;

                totalpayment();
                assesspayment();
                $('#payments').append(rowpay);
                clearpay();
            } else {
                totalpay = parseFloat(totalpay) - parseFloat(pay);
                //alert("Rellene todos los campos del detalle de la venta");
                Swal.fire({
                    type: 'error',
                    //title: 'Oops...',
                    text: 'Abono supera el saldo del Pedido',
                });
            }
        } else {
            //alert("Rellene todos los campos del detalle de la venta");
            Swal.fire({
            type: 'error',
            //title: 'Oops...',
            text: 'Rellene todos los campos del detalle del pago',
            });
        }
    }
    function clearpay(){
            $("#payment_method_id").val("");
            $("#bank_id").val("");
            $("#card_id").val("");
            $("#pay").val("");
            $("#transaction").val("");
        }
        function totalpayment(){

            $("#totalpay_html").html("$ " + totalpay.toFixed(2));
            $("#totalpay").val(totalpay.toFixed(2));
            $("#pendient").val(rbalance);
        }
        function assesspayment(){

            if(totalpay>0){

            $("#save").show();

        } else{

            $("#save").hide();
        }
    }
    function deletepay(index){
        paydelete = paycont[index];
        pendient = $("#pendient").val();
        newpendient = parseFloat(pendient) + parseFloat(paydelete);


        totalpay = totalpay-paycont[index];
        $("#totalpay_html").html("$ " + totalpay.toFixed(2));
        $("#totalpay").val(totalpay.toFixed(2));

        $("#pendient").val(newpendient);
        $("#rowpay" + index).remove();
        assesspayment();
    }
</script>
