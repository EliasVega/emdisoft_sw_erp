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

        cash = parseFloat($("#cash").val());

        if(cash < 0){
            //alert("Rellene todos los campos del detalle de la venta");
            Swal.fire({
            type: 'error',
            //title: 'Oops...',
            text: 'Estas ingresando un valor negativo',
            })
            $("#cash").val("")
        }
    }
    function assign(){
        cash = $("#cash").val();


        if(cash <= 0 || cash == ""){
            //alert("Rellene todos los campos del detalle de la venta");
            Swal.fire({
            type: 'error',
            //title: 'Oops...',
            text: 'Primero debes digitar la cantidad a Ingresar',
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
