<script>
    /*$(document).ready(function(){
            alert('estoy funcionando correctamanete empresa');
        });*/
        jQuery(document).ready(function($){
            $(document).ready(function() {
                $('#third').select2({
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
                $('#provider_id').select2({
                    theme: "classic",
                    width: "100%",
                });
            });
        });
        jQuery(document).ready(function($){
            $(document).ready(function() {
                $('#employee_id').select2({
                    theme: "classic",
                    width: "100%",
                });
            });
        });
        var cont=0;
        total=0;
        $("#client").hide();
        $("#supplier").hide();
        $("#worker").hide();

        //funcion para seleccionar el tipo de tercero visible o no
        $(document).ready(function(){
            $("#third").change(function(){
                third = $("#third").val();
                if(third == 1){
                    $("#client").show();
                    $("#supplier").hide();
                    $("#worker").hide();
                }else if(third == 2){
                    $("#supplier").show();
                    $("#client").hide();
                    $("#worker").hide();
                } else if(third == 3){
                    $("#worker").show();
                    $("#supplier").hide();
                    $("#client").hide();
                } else {
                    $("#worker").hide();
                    $("#supplier").hide();
                    $("#client").hide();
                }
            });
        });

        $(document).ready(function(){
            $("#add").click(function(){
                add();
            });
        });

        //funcion para adicionar medio de pago a los anticipos
        function add(){
            payment_method_id = $("#payment_method_id").val();
            payment_method    = $("#payment_method_id option:selected").text();
            bank_id     = $("#bank_id").val();
            bank        = $("#bank_id option:selected").text();
            card_id   = $("#card_id").val();
            card      = $("#card_id option:selected").text();
            pay        = $("#pay").val();
            transaction  = $("#transaction").val();


            if(payment_method_id !="" && bank_id!="" && card_id!=""  && pay!="" && pay>0 && transaction!=""){

                total = parseFloat(total) + parseFloat(pay);

                var fila= '<tr class="selected" id="fila'+cont+'"><td><button type="button" class="btn btn-danger btn-sm" onclick="eliminar('+cont+');"><i class="fa fa-times"></i></button></td> <td><input type="hidden" name="payment_method_id[]" value="'+payment_method_id+'">'+payment_method+'</td> <td><input type="hidden" name="card_id[]" value="'+card_id+'">'+card+'</td> <td><input type="hidden" name="bank_id[]" value="'+bank_id+'">'+bank+'</td> <td><input type="hidden" name="transaction[]" value="'+transaction+'">'+transaction+'</td> <td class="tdder"><input type="hidden" name="pay[]" value="'+pay+'">'+pay+'</td>  </tr>';
                cont++;

                totals();
                assess();
                $('#details').append(fila);
                clean();
            } else {
                //alert("Rellene todos los campos del detalle de la venta");
                Swal.fire({
                type: 'error',
                //title: 'Oops...',
                text: 'Rellene todos los campos del detalle de la Pedido',
                });
            }
        }
        function clean(){
            $("#payment_method_id").val("");
            $("#bank_id").val("");
            $("#card_id").val("");
            $("#pay").val("");
            $("#transaction").val("");
            $("#banky").hide();
            $("#cardy").hide();
            $("#transactiony").hide();
            $("#mpay").hide();
            $("#payi").hide();
        }
        function totals(){
            $("#total_html").html("$ " + total.toFixed(2));
            $("#total").val(total.toFixed(2));
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

            $("#total_html").html("$ " + total.toFixed(2));
            $("#total").val(total.toFixed(2));

            $("#fila" + index).remove();
            assess();
        }
</script>
