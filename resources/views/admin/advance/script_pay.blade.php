<script>
    /*$(document).ready(function(){
            alert('estoy funcionando correctamanete empresa');
        });*/
        jQuery(document).ready(function($){
            $(document).ready(function() {
                $('#bank_id').select2({
                    theme: "classic",
                    width: "100%",
                });
            });
        });
        jQuery(document).ready(function($){
            $(document).ready(function() {
                $('#card_id').select2({
                    theme: "classic",
                    width: "100%",
                });
            });
        });
        var cont=0;
        total=0;
        $("#save").hide();
        $("#banky").hide();
        $("#cardy").hide();
        $("#transactiony").hide();
        $("#mpay").hide();
        $("#payi").hide();



        $(document).ready(function(){
            $("#noDefined").click(function(){
                $("#pay").val("");
                noDefined();
            });
        });
        function noDefined(){
            $("#payi").show();
            $("#transaction").val('Metodo No definido');
            $("#bank_id").val(1);
            $("#card_id").val(1);
            $("#banky").hide();
            $("#cardy").hide();
            $("#transactiony").hide();
            $("#payment_method_id").val(1);
        }

        $(document).ready(function(){
            $("#cash").click(function(){
                $("#pay").val("");
                payCash();
            });
        });
        function payCash(){
            $("#payi").show();
            $("#transaction").val("Efectivo");
            $("#bank_id").val(1);
            $("#card_id").val(1);
            $("#transactiony").hide();
            $("#banky").hide(1);
            $("#cardy").hide(1);
            $("#payment_method_id").val(10);
        }

        $(document).ready(function(){
            $("#card1").click(function(){
                $("#pay").val("");
                payCard1();
            });
        });
        function payCard1(){
            $("#payi").show();
            $("#banky").show();
            $("#cardy").show();
            $("#transactiony").show();
            $("#payment_method_id").val(48);
        }

        $(document).ready(function(){
            $("#card2").click(function(){
                $("#pay").val("");
                payCard2();
            });
        });
        function payCard2(){
            $("#payi").show();
            $("#banky").show();
            $("#cardy").show();
            $("#transactiony").show();
            $("#payment_method_id").val(49);
        }

        $(document).ready(function(){
            $("#transfer").click(function(){
                $("#pay").val("");
                payTransaction();
            });
        });
        function payTransaction(){
            $("#payi").show();
            $("#card_id").val(1);
            $("#transactiony").show();
            $("#banky").show();
            $("#cardy").hide();
            $("#payment_method_id").val(47);
        }

        $(document).ready(function(){
            $("#nequi").click(function(){
                $("#pay").val("");
                payNequi();
            });
        });
        function payNequi(){
            $("#bank_id").val(2);
            $("#card_id").val(1);
            $("#payi").show();
            $("#transactiony").show();
            $("#cardy").hide();
            $("#banky").hide();
            $("#payment_method_id").val(47);
        }
</script>
