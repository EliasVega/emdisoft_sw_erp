<script>
    /*$(document).ready(function(){
            alert('estoy funcionando correctamanete empresa');
        });*/

        $(document).ready(function(){
            $("#cash").blur(function(){
                valuing();
                assess();
            });
        });

        $(document).ready(function(){
            $("#admin_id").click(function(){
                assign();
            });
        });
        valor = 0;
        admin = "";
        $("#save").hide();

    function valuing(){

        boxy = parseFloat($("#box").val());
        payment = parseFloat($("#cash").val());

        if(cash > box){
            //alert("Rellene todos los campos del detalle de la venta");
            Swal.fire({
            type: 'error',
            //title: 'Oops...',
            text: 'El valor a retirar de caja supera la cantidad existente',
            })
            $("#cash").val("")
        }
    }
    function assign(){
        payment = $("#cash").val();


        if(cash <= 0 || cash == ""){
            //alert("Rellene todos los campos del detalle de la venta");
            Swal.fire({
            type: 'error',
            //title: 'Oops...',
            text: 'Primero debes digitar la cantidad a Retirar',
            })
        }
    }

    function assess(){

        if(cash > 0){
            $("#save").show();
        } else{
            $("#save").hide();
        }
    }
</script>
