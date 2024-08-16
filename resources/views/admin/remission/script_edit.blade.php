<script>
    /*$(document).ready(function(){
            alert('estoy funcionando correctamanete empresa');
        });*/

    $("#addReverse").hide();
    $("#addRemissionPayments").hide();

    //function editing(){
    pr = {!! json_encode($productRemissions) !!};
    pr.forEach((value, i) => {

        if (value['quantity'] > 0) {
            id = value['id'];
            product_id = value['idP'];
            product = value['name'];
            quantity = value['quantity'];
            price = value['price'];
            tax_rate = value['tax_rate'];
            subt = value['subtotal'];
            taxSubt = value['tax_subtotal'];
            pwx = $("#pwx").val();
            if (product_id != "" && quantity != "" && quantity > 0 && price != "" && price > 0) {
                subtotal[cont] = subt;
                total = total + subtotal[cont];
                ivita = taxSubt;
                tax_cont[cont] = ivita;
                total_tax = total_tax + ivita;
                subcont = subtotal[cont]
                rowsList(cont, product_id, product, quantity, price, ivita, tax_rate, subcont);
                cont++;

                totals();
                assess();
                $('#details').append(row);
                $('#editModal').modal('hide');
                $("#totalPartial").val(total);
                //$('#product_id option:selected').remove();
            } else {
                // alert("Rellene todos los campos del detalle de la compra, revise los datos del producto");
                Swal.fire({
                    type: 'error',
                    //title: 'Oops...',
                    text: 'Rellene todos los campos del detalle de la compra',
                })
            }
        }
    });
    //}

    function assessEdit() {
        remissionPayments = $("#remission_payments").val();

        if (remissionPayments < total_pay) {
            pendientEdit = parseFloat(total_pay) - parseFloat(remissionPayments);
            $("#pendient").val(pendientEdit.toFixed(2));
        } else {
            $("#addReverse").show();
            $("#formPayCard").hide();
            $("#formCard").show();
            $("#payment_form_id").val(2);
            $("#payment_method_id").val(1);
            $("#save").show();

        }


    }
</script>
