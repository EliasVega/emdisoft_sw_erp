<script>
    /*$(document).ready(function(){
            alert('estoy funcionando correctamanete empresa');
        });*/

    //Selecciona el municipio de acuerdo al departamento

    jQuery(document).ready(function($) {
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
    $("#payment_method_id").val(2);

    /*
    $("#percentage").val(0);
    */

    $(document).ready(function() {
        $("#payment_form_id").change(function() {
            form = $("#payment_form_id").val();
            if (form == 1) {
                $("#returnedBalance").show();
                $("#valuePay").show();
                $("#payment_method_id").val(10);
            } else {
                $("#returnedBalance").hide();
                $("#valuePay").hide();
                $("#payment_method_id").val(1);
            }
        });
    });

    $(document).ready(function() {
        $("#pay").keyup(function() {
            $("#pay").val();
            $("#returned").val();
            paymentor();
        });
    });

    function paymentor() {
        ttp = parseFloat($("#pendient").val())
        abn = parseFloat($("#pay").val())
        balancey = ttp - abn;
        $("#returned").val(balancey);
    }

    function assesspayment() {

        if (totalpay > 0) {

            $("#save").show();

        } else {

            $("#save").hide();
        }
    }
</script>
