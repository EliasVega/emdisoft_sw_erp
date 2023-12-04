<script>
    /*$(document).ready(function(){
            alert('estoy funcionando correctamanete empresa');
        });*/
    jQuery(document).ready(function($){
        $(document).ready(function() {
            $('#payment_method_id').select2({
                theme: "classic",
                width: "100%",
            });
        });
    });
    var cont=0;
    total=0;
    //form purchase
    $("#save").hide();
    //form pay
    $("#mpay").hide();

    $("#advancey").hide();
    $("#abpaymenty").hide();
    $("#transactiony").hide();
    $("#banky").hide();
    $("#cardy").hide();
    $("#advanceId").hide();
    $("#types").hide();
    $("#payi").hide();
    $("#returny").hide();
    $("#balancy").hide();
    $("#total_p").hide();
    //$("#document_id").hide();
    /*
    $("#abadvance").hide();
    $("#order").val();

    */

    $(document).ready(function(){
        $("#add").click(function(){
            add();
        });
    });
    function add(){

        payment_method_id = $("#payment_method_id").val();
        payment_method    = $("#payment_method_id option:selected").text();
        bank_id     = $("#bank_id").val();
        bank        = $("#bank_id option:selected").text();
        card_id   = $("#card_id").val();
        card      = $("#card_id option:selected").text();
        pay        = $("#pay").val();
        transaction  = $("#transaction").val();
        pendient    = $("#pendient").val();

        if(payment_method_id !="" && bank_id!="" && card_id!=""  && pay!="" && pay>0 && transaction!=""){
            total = parseFloat(total) + parseFloat(pay);
            rbalance = parseFloat(pendient)-total;
            pendient = parseFloat(pendient);

            if (pendient >= total) {
                var fila= '<tr class="selected" id="fila'+cont+'"><td><button type="button" class="btn btn-danger btn-sm" onclick="eliminar('+cont+');"><i class="fa fa-times"></i></button></td> <td><input type="hidden" name="payment_method_id[]" value="'+payment_method_id+'">'+payment_method+'</td> <td><input type="hidden" name="card_id[]" value="'+card_id+'">'+card+'</td> <td><input type="hidden" name="bank_id[]" value="'+bank_id+'">'+bank+'</td> <td><input type="hidden" name="transaction[]" value="'+transaction+'">'+transaction+'</td> <td><input type="hidden" name="pay[]" value="'+pay+'">'+pay+'</td>  </tr>';
                cont++;

                totals();
                assess();
                $('#details').append(fila);
                clean();
            } else {
                total = parseFloat(total) - parseFloat(pay);
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
            text: 'Rellene todos los campos del detalle del Apago',
            });
        }
    }
    function clean(){
        $("#payment_method_id").val("");
        $("#bank_id").val("");
        $("#card_id").val("");
        $("#pay").val("");
        $("#transaction").val("");
        $("#payi").hide();
        $("#returny").hide();
        $("#balancy").hide();
    }
    function totals(){

        $("#totalpay_html").html("$ " + total.toFixed(2));
        $("#totalpay").val(total.toFixed(2));

        $("#balance").val(rbalance);
    }
    function assess(){
        if(total>0){
            $("#save").show();
        } else{
            $("#save").hide();
        }
    }
    function eliminar(index){

        total = total-pay[index];

        $("#totalpay_html").html("$ " + total.toFixed(2));
        $("#totalpay").val(total.toFixed(2));

        $("#fila" + index).remove();
        assess();
    }
    $(document).ready(function(){
        $("#cash").click(function(){
            tpay = $("#balance").val();
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
        $("#banky").hide();
        $("#cardy").hide();
        $("#transactiony").hide();
        $("#payi").show();
        $("#abpaymenty").hide();
        $("#advanceId").hide();
        $("#payment").val(0);
        $("#returny").show();
        $("#balancy").show();
        $("#total_p").show();
    }
    $(document).ready(function(){
        $("#transfer").click(function(){
            tpay = $("#balance").val();
            $("#pay").val(tpay);
            payTransaction();
        });
    });
    function payTransaction(){
        $("#pay").val();
        $("#returned").val(0);
        $("#payment_method_id").val(47);
        $("#card_id").val(1);
        $("#payi").show();
        $("#abpaymenty").hide();
        $("#transactiony").show();
        $("#banky").show();
        $("#cardy").hide();
        $("#mpay").hide();
        $("#payment").val(0);
        $("#returny").show();
        $("#balancy").show();
        $("#total_p").show();
    }
    $(document).ready(function(){
        $("#nequi").click(function(){
            tpay = $("#balance").val();
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
        $("#payi").show();
        $("#abpaymenty").hide();
        $("#transactiony").show();
        $("#cardy").hide();
        $("#mpay").hide();
        $("#banky").hide();
        $("#payment").val(0);
        $("#returny").show();
        $("#balancy").show();
        $("#total_p").show();
    }
    $(document).ready(function(){
        $("#card1").click(function(){
            tpay = $("#balance").val();
            $("#pay").val(tpay);
            payCard1();
        });
    });
    function payCard1(){
        $("#pay").val();
        $("#returned").val(0);
        $("#payment_method_id").val(48);
        $("#abpaymenty").hide();
        $("#mpay").hide();
        $("#payi").show();
        $("#banky").show();
        $("#cardy").show();
        $("#transactiony").show();
        $("#payment").val(0);
        $("#returny").show();
        $("#balancy").show();
        $("#total_p").show();
    }
    $(document).ready(function(){
        $("#card2").click(function(){
            tpay = $("#balance").val();
            $("#pay").val(tpay);
            payCard2();
        });
    });

    function payCard2(){
        $("#pay").val();
        $("#returned").val(0);
        $("#payment_method_id").val(49);
        $("#abpaymenty").hide();
        $("#mpay").hide();
        $("#payi").show();
        $("#banky").show();
        $("#cardy").show();
        $("#transactiony").show();
        $("#payment").val(0);
        $("#returny").show();
        $("#balancy").show();
        $("#total_p").show();
    }
    $(document).ready(function(){
        $("#noDefined").click(function(){
            tpay = $("#balance").val();
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
        $("#transactiony").show();
        $("#banky").hide();
        $("#cardy").hide();
        $("#payi").show();
        $("#abpaymenty").hide();
        $("#advanceId").hide();
        $("#payment").val(0);
        $("#returny").show();
        $("#balancy").show();
        $("#total_p").show();
    }

    $(document).ready(function(){
        $("#paymentThird").click(function(){
            tpay = $("#balance").val();
            $("#pay").val(tpay);
            paymentThird();
        });
    });
    function paymentThird(){
        $("#pay").val();
        $("#returned").val(0);
        $("#payment_method_id").val(1);
        $("#transaction").val("N/A");
        $("#bank_id").val(1);
        $("#card_id").val(1);
        $("#payi").hide();
        $("#abpaymenty").show();
        $("#transactiony").hide();
        $("#cardy").hide();
        $("#mpay").hide();
        $("#banky").hide();
        $("#advanceId").show();
        $("#returny").show();
        $("#balancy").show();
        $("#advancey").show();
        $("#total_p").show();
    }

    $(document).ready(function(){
        $("#pay").keyup(function(){
            $("#pay").val();
            payment();
        });
    });
    function payment(){
        ttp = parseFloat($("#balance").val())
        abn = parseFloat($("#pay").val())
        balancey = ttp - abn;
        if (ttp >= abn) {
            $("#returned").val(balancey);
        } else {
            Swal.fire(
                'Error!',
                'Cantidad supera el saldo a pagar!',
                'danger'
            )
            $("#pay").val(ttp);
            $("#returned").val(0);
            payment();
        }
    }
    /*
    prueba = [];
    $("#supplier_id").change(function(event){
        $.get("getpayment/" + event.target.value + "", function(response){
            $("#payment_id").empty();
            $("#payment_id").append("<option value = '#' disabled selected>Seleccionar ...</option>");
            for(i = 0; i < response.length; i++){
                $("#payment_id").append("<option value = '" + response[i].id + "'>" + response[i].origin + '  ' + response[i].balance + "</option>");
                prueba = response[i].balance;
            }
            $("#payment_id").selectpicker('refresh');
        });
    });
    $(document).ready(function(){
        $("#payment_id").change(function(){
            parseFloat($("#abpayment").val(prueba))
            $("#abpaymenty").show();
            prepaidnew();
        });
    });*/
    $("#advance_id").change(paymentValue);

    function paymentValue(){
        dataPayment = document.getElementById('advance_id').value.split('_');
        adv = dataPayment[1]
        parseFloat($("#payment").val(adv));
        parseFloat($("#advance").val(adv));
        ttp = parseFloat($("#balance").val())
        if (ttp >= adv) {
            parseFloat($("#returned").val(ttp - adv));
        } else {
            $("#returned").val(0);
        }

        $("#abpaymenty").show();
        prepaidnew();
    }
    function prepaidnew(){
        ttp = parseFloat($("#balance").val())
        abn = parseFloat($("#abpayment").val())
        balancey = ttp - abn;
        if (ttp >= abn) {
            $("#returned").val(balancey);
            $("#pay").val(abn);
            $("#payment").val(abn);
        } else {
            $("#abadvance").show();
            //prepaid()
        }
    }
    $(document).ready(function(){
        $("#payment").keyup(function(){
            $("#payment").val();
            prepaid();
        });
    });
    function prepaid(){
        ttpnew = parseFloat($("#balance").val())
        abnnew = parseFloat($("#payment").val())
        balanceynew = ttpnew - abnnew;
        if (ttpnew >= abnnew) {
            $("#returned").val(balanceynew);
            $("#payment").val(abnnew);
            $("#pay").val(abnnew);
        } else {
            if (abnnew > 0) {
                //alert("Rellene todos los campos del detalle de la venta");
                Swal.fire({
                type: 'error',
                //title: 'Oops...',
                text: 'El abono supera el valor de la compra',
                })
                $("#payment").val(0)
                prepaid();
            } else {
                $("#payment").val(0)
                prepaid();
            }

        }
    }
</script>
