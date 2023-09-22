<script>
    /*$(document).ready(function(){
            alert('estoy funcionando correctamanete empresa');
        });*/
    jQuery(document).ready(function($){
        $(document).ready(function() {
            $('#payment_form_id').select2({
                theme: "classic",
                width: "100%",
            });
        });
    });
    jQuery(document).ready(function($){
        $(document).ready(function() {
            $('#payment_method_id').select2({
                theme: "classic",
                width: "100%",
            });
        });
    });
    //form pay
    $("#cash").hide();
    $("#transfer").hide();
    $("#nequi").hide();
    $("#card1").hide();
    $("#card2").hide();
    $("#noDefined").hide();
    $("#advance").hide();
    $("#editPayPayment").hide();

    //$("#payPurchase").hide();

    $("#payPay").hide();
    $("#payPaymentAdvance").hide();
    $("#payAdvance").hide();
    $("#payTransaction").hide();
    $("#payBank").hide();
    $("#payCard").hide();
    $("#payAdvanceId").hide();

    $(document).ready(function(){
        $("#payment_form_id").change(function(){
            form = $("#payment_form_id").val();
            if(form == 1){
                $("#noDefined").show();
                $("#cash").show();
                $("#advance").show();
                $("#transfer").show();
                $("#nequi").show();
                $("#card1").show();
                $("#card2").show();
                $("#mpay").hide();
                $("#editPayPayment").hide();
            }else{
                $("#editPayPayment").show();
                $("#noDefined").hide();
                $("#cash").hide();
                $("#advance").hide();
                $("#transfer").hide();
                $("#nequi").hide();
                $("#card1").hide();
                $("#card2").hide();
                $("#mpay").hide();
                $("#payment_method_id").val(1);

                $("#pay").val();
                $("#returned").val(0);
                $("#transaction").val("N/A");
                $("#bank_id").val(1);
                $("#card_id").val(1);
                $("#advance").val(0);
            }
        });
    });

    function seePay(){
        totalInvoice = $("#balance").val();
        totalPay = $("#pay_purchase").val();
        tpay = totalInvoice - totalPay;
        if (tpay <= 0) {
            $("#payment_form_id").val(2);
            $("#payment_method_id").val(1);
            $("#fpay").hide();
            $("#mpay").hide();
        }
    }

    $(document).ready(function(){
        $("#payPays").click(function(){
            see();
        });
    });
    function see(){
        $("#noDefined").show();
        $("#cash").show();
        $("#advance").show();
        $("#transfer").show();
        $("#nequi").show();
        $("#card1").show();
        $("#card2").show();
        $("#mpay").hide();
        $("#editPayPayment").hide();
    }
    $(document).ready(function(){
        $("#cash").click(function(){
            totalInvoice = $("#balance").val();
            totalPay = $("#pay_purchase").val();
            tpay = totalInvoice - totalPay;
            $("#pay").val(tpay);
            payCash();
        });
    });
    function payCash(){
        $("#pay").val();
        $("#returned").val(0);
        $("#payment_method_id").val(10);
        $("#transaction").val("N/A");
        $("#bank_id").val(1);
        $("#card_id").val(1);
        $("#payBank").hide();
        $("#payCard").hide();
        $("#payTransaction").hide();
        $("#payPay").show();
        $("#payPaymentAdvance").hide();
        $("#payAdvanceId").hide();
        $("#advance").val(0);
    }
    $(document).ready(function(){
        $("#transfer").click(function(){
            totalInvoice = $("#balance").val();
            totalPay = $("#pay_purchase").val();
            tpay = totalInvoice - totalPay;
            $("#pay").val(tpay);
            payTransaction();
        });
    });
    function payTransaction(){
        $("#pay").val();
        $("#returned").val(0);
        $("#payment_method_id").val(47);
        $("#card_id").val(1);
        $("#payPay").show();
        $("#payPaymentAdvance").hide();
        $("#payTransaction").show();
        $("#payBank").show();
        $("#payCard").hide();
        $("#mpay").hide();
        $("#payAdvanceId").hide();
    }
    $(document).ready(function(){
        $("#nequi").click(function(){
            totalInvoice = $("#balance").val();
            totalPay = $("#pay_purchase").val();
            tpay = totalInvoice - totalPay;
            $("#pay").val(tpay);
            payNequi();
        });
    });
    function payNequi(){
        $("#pay").val();
        $("#returned").val(0);
        $("#payment_method_id").val(47);
        $("#bank_id").val(2);
        $("#card_id").val(1);
        $("#payPay").show();
        $("#payPaymentAdvance").hide();
        $("#payTransaction").show();
        $("#payCard").hide();
        $("#mpay").hide();
        $("#payBank").hide();
        $("#payAdvanceId").hide();
    }
    $(document).ready(function(){
        $("#card1").click(function(){
            totalInvoice = $("#balance").val();
            totalPay = $("#pay_purchase").val();
            tpay = totalInvoice - totalPay;
            $("#pay").val(tpay);
            payCard1();
        });
    });
    function payCard1(){
        $("#pay").val();
        $("#returned").val(0);
        $("#payment_method_id").val(48);
        $("#payPaymentAdvance").hide();
        $("#mpay").hide();
        $("#payPay").show();
        $("#payBank").show();
        $("#payCard").show();
        $("#payAdvanceId").hide();
        $("#payTransaction").show();
    }
    $(document).ready(function(){
        $("#card2").click(function(){
            totalInvoice = $("#balance").val();
            totalPay = $("#pay_purchase").val();
            tpay = totalInvoice - totalPay;
            $("#pay").val(tpay);
            payCard2();
        });
    });
    function payCard2(){
        $("#pay").val();
        $("#returned").val(0);
        $("#payment_method_id").val(49);
        $("#payPaymentAdvance").hide();
        $("#mpay").hide();
        $("#payPay").show();
        $("#payBank").show();
        $("#payCard").show();
        $("#payAdvanceId").hide();
        $("#payTransaction").show();
    }
    $(document).ready(function(){
        $("#noDefined").click(function(){
            totalInvoice = $("#balance").val();
            totalPay = $("#pay_purchase").val();
            tpay = totalInvoice - totalPay;
            $("#pay").val(tpay);
            noDefined();
        });
    });
    function noDefined(){
        $("#pay").val();
        $("#returned").val(0);
        $("#payment_method_id").val(1);
        $("#transaction").val("N/A");
        $("#bank_id").val(1);
        $("#card_id").val(1);
        $("#payTransaction").show();
        $("#payBank").hide();
        $("#payCard").hide();
        $("#payPay").show();
        $("#payPaymentAdvance").hide();
        $("#payAdvanceId").hide();
        $("#advance").val(0);
    }
    $(document).ready(function(){
        $("#advance").click(function(){
            totalInvoice = $("#balance").val();
            totalPay = $("#pay_purchase").val();
            tpay = totalInvoice - totalPay;
            $("#pay").val(tpay);
            advance();
        });
    });
    function advance(){
        $("#pay").val();
        $("#returned").val(0);
        $("#payment_method_id").val(1);
        $("#transaction").val("N/A");
        $("#bank_id").val(1);
        $("#card_id").val(1);
        $("#payPay").hide();
        $("#payPaymentAdvance").show();
        $("#payTransaction").hide();
        $("#payCard").hide();
        $("#mpay").hide();
        $("#payBank").hide();
        $("#payAdvanceId").show();
    }

    $(document).ready(function(){
        $("#pay").keyup(function(){
            $("#pay").val();
            $("#returned").val();
            payment();
        });
    });
    function payment(){
        ttp = parseFloat($("#total_pay").val())
        tpi = parseFloat($("#pay_purchase").val())
        abn = parseFloat($("#pay").val())
        tpiabn = tpi + abn;
        balancey = ttp - (tpi + abn);
        if (ttp >= tpiabn) {
            $("#returned").val(balancey);
        } else {
            //alert("Rellene todos los campos del detalle de la venta");
            Swal.fire({
            type: 'error',
            //title: 'Oops...',
            text: 'El abono supera el valor de la venta',
            })
            $("#pay").val(0)
            payment();
        }
    }
    prueba = [];
    $("#provider_id").change(function(event){
        $.get("advanceProvider/" + event.target.value + "", function(response){
            $("#advance_id").empty();
            $("#advance_id").append("<option value = '#' disabled selected>Seleccionar ...</option>");
            for(i = 0; i < response.length; i++){
                $("#advance_id").append("<option value = '" + response[i].id + "'>" + response[i].origin + '  ' + response[i].balance + "</option>");
                prueba = response[i].balance;
            }
            $("#advance_id").selectpicker('refresh');
        });
    });
    $(document).ready(function(){
        $("#advance_id").change(function(){
            parseFloat($("#abpayment").val(prueba))
            $("#payPaymentAdvance").show();
            prepaidnew();
        });
    });
    function prepaidnew(){
        ttp = parseFloat($("#total_pay").val())
        tpp = parseFloat($("#pay_purchase").val())
        abn = parseFloat($("#abpayment").val())
        tpp_abn = tpp + abn;
        balancey = ttp - (tpp + abn);
        if (ttp >= tpp_abn) {
            $("#returned").val(balancey);
            $("#pay").val(abn);
            $("#payment").val(abn);
        } else {
            $("#payAdvance").show();
            //prepaid()
        }
    }
    $(document).ready(function(){
        $("#advance").keyup(function(){
            $("#advance").val();
            prepaid();
        });
    });
    function prepaid(){
        ttpnew = parseFloat($("#total_pay").val())
        tppnew = parseFloat($("#pay_purchase").val())
        abnnew = parseFloat($("#advance").val())
        tppnew_abnnew = tppnew + abn;
        balanceynew = ttpnew - (tppnew + abnnew);
        if (ttpnew >= tppnew_abnnew) {
            $("#returned").val(balanceynew);
            $("#advance").val(abnnew);
            $("#pay").val(abnnew);
        } else {
            //alert("Rellene todos los campos del detalle de la venta");
            Swal.fire({
            type: 'error',
            //title: 'Oops...',
            text: 'El abono supera el valor de la compra',
            })
            $("#advance").val(0)
            prepaid();
        }
    }
</script>

<script>

</script>

