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
    $("#pendaddModal").hide();
    //$("#methodPayModal").hide();
    $("#payposorigin").hide();
    $("#payment_method_modal").val(2);
    $("#returnedBalanceModal").hide();
    $("#valuePayModal").hide();
    $("#save").hide();
    $("#vpayadd").hide();
    $("#rbadd").hide();
    /*
    $("#percentage").val(0);
    */

    $(document).ready(function(){
        $("#payment_form_modal").change(function(){
            form = $("#payment_form_modal").val();
            if(form == 1){
                $("#save").hide();
                $("#returnedBalanceModal").show();
                $("#valuePayModal").show();
                $("#payment_method_modal").val(10);
                $("#payModal").val(0);
                $("#returnedModal").val(0);
                $('#payModal').prop("required", true);
            }else{
                $("#returnedBalanceModal").hide();
                $("#valuePayModal").hide();
                $("#payment_method_modal").val(1);
                $("#payModal").val(0);
                $("#returnedModal").val(0);
                $('#payModal').prop("required", false);
                $("#save").show();
            }
        });
    });

    $(document).ready(function(){
        $("#payModal").keyup(function(){
            $("#payModal").val();
            $("#returnedModal").val();
            paymentor();
        });
    });

    function paymentor(){
        ttp = parseFloat($("#pendientModal").val())
        abn = parseFloat($("#payModal").val())
        balancey = ttp - abn;
        $("#returnedModal").val(balancey);
        assesspayment();
    }

    function assesspayment(){
        remission = $("#returnedModal").val();
        if(remission <= 0){
            $("#save").show();

        } else{
            $("#save").hide();
        }
    }

    var contpay=0;
    totalpay=0;

    jQuery(document).on("click", "#savePayment", function () {
        updatePayPos();
        $('#payPos').modal('hide');
    });

    function updatePayPos() {
        pfModal = $("#payment_form_modal").val();
        pmModal = $("#payment_method_modal").val();
        balanceMod = $("#balanceModal").val();
        pendientMod = $("#pendientModal").val();
        payMod = $("#payModal").val();
        returnedMod = $("#returnedModal").val();
        $("#payment_form_id").val(pfModal);
        $("#payment_method_id").val(pmModal);
        $("#balance").val(balanceMod);
        $("#pendient").val(pendientMod);
        $("#pay").val(payMod);
        $("#returned").val(returnedMod);
        $("#vpay").val(payMod);
        $("#rbal").val(returnedMod);
        $("#vpayadd").show();
        $("#rbadd").show();
        $("#payposadd").hide();
    }
</script>
