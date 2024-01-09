<script>
    /*$(document).ready(function(){
            alert('estoy funcionando correctamanete empresa');
        });*/

    var cont = 0;
    var total_payment = 0;
    function totalBalances(){
        $("#total_balance_html").html("$ " + total_payment.toFixed(2));
        $("#total_balance").val(total_payment.toFixed(2));
    }

    //function editing(){
        thirdDocument = {!! json_encode($documents) !!};
        thirdDocument.forEach((value, i) => {
            if (value['balance'] > 0) {
                iddoc = value['id'];
                numberdoc = value['document'];

                createddoc = new Date(value['created_at']).toLocaleDateString();
                //createddoc = new toLocaleDateString(datebal);
                valueTotal = value['total_pay'];
                balanceTotal = value['balance'];
                if(numberdoc !="" && valueTotal !="" && valueTotal > 0  && balanceTotal != "" && balanceTotal > 0){
                    total_payment = total_payment + parseFloat(balanceTotal);
                    var row= '<tr class="selected" id="row'+cont+'"><td><input type="hidden" name="document[]"  value="'+numberdoc+'">'+numberdoc+'</td><td><input type="hidden" name="datedocl[]" value="'+createddoc+'">'+createddoc+'</td><td><input type="hidden" name="value_total[]" value="'+valueTotal+'">'+valueTotal+'</td><td><input type="hidden" name="balance_total[]"  value="'+balanceTotal+'">'+balanceTotal+'</td></tr>';
                    cont++;
                    totalBalances();
                    $('#balancelist').append(row);

                }else{
                    //alert("Rellene todos los campos del detalle para esta compra");
                    Swal.fire({
                    type: 'error',
                    //title: 'Oops...',
                    text: 'No tiene documentos pendientes poa pagar',
                    })
                }
            }
        });
    //}
</script>
