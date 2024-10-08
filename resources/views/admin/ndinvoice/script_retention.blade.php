<script>
    /*$(document).ready(function(){
            alert('estoy funcionando correctamanete empresa');
        });*/

        //Selecciona el municipio de acuerdo al departamento
    jQuery(document).ready(function($){
        $(document).ready(function() {
            $('#company_tax_id').select2({
                theme: "classic",
                width: "100%",
            });
        });
    });

    //$("#totalDocument").hide();
    //$("#addPercentage").hide();
    $("#infoIva").hide();
    $("#infoType").hide();
    $("#infoBase").hide();

    let totalRetention = [];
    let contRetention = 0;
    let total_retention = 0;
    let iva = 0;
    
    //seleccionar de acuerdo ala retencion
    $("#company_tax_id").change(taxCompany);

    function taxCompany(){
        dataTax = document.getElementById('company_tax_id').value.split('_');
        $("#percentage").val(dataTax[1]);
        $("#taxTypeId").val(dataTax[2]);
        $("#base").val(dataTax[3]);
        $("#total_document").val(total);
    }
    $(document).ready(function(){
        $("#withhold").click(function(){
            withhold();
        });
    });
    function withhold(){

        dataTax = document.getElementById('company_tax_id').value.split('_');
        company_tax_id = dataTax[0];
        companyTax = $("#company_tax_id option:selected").text();
        percentage = $("#percentage").val();
        ttid = $("#taxTypeId").val();
        balance = $("#balance").val();
        base = parseFloat($("#base").val());
        if(company_tax_id !="" && companyTax!="" && percentage!=""  && percentage>0 ){
            if (ttid == 5) {
                totalRetention[contRetention] = iva * percentage/100;
            } else {
                totalRetention[contRetention] = total * percentage/100;
            }
            /*
            if (ttid == 5) {
                if (tax_iva > base) {
                    totalRetention[contRetention] = iva * percentage/100;
                } else {
                    totalRetention[contRetention] = 0;
                }
            } else {
                if (base < total) {
                    totalRetention[contRetention] = total * percentage/100;
                } else {
                    totalRetention[contRetention] = 0;
                }
            }*/
            total_retention += totalRetention[contRetention];
            balance -= totalRetention[contRetention];
            var row= '<tr class="selected" id="row'+contRetention+'"><td><button type="button" class="btn btn-danger btn-xs" onclick="deleteRetention('+contRetention+');"><i class="fa fa-times"></i></button></td><td><input type="hidden" name="company_tax_id[]" value="'+company_tax_id+'">'+companyTax+'</td><td> $'+parseFloat(totalRetention[contRetention]).toFixed(2)+'</td></tr>';
            contRetention++;

            $("#balance").val(balance);
            $("#pendient").val(balance);
            retentionTotals();
            $('#retentions').append(row);
            $('#company_tax_id option:selected').remove();
            clear();
        } else {
            //alert("Rellene todos los campos del detalle de la venta");
            Swal.fire({
            type: 'error',
            //title: 'Oops...',
            text: 'Rellene todos los campos del detalle del Apago',
            });
        }
    }
    function clear(){
        $("#company_tax_id").val("");
        $("#percentage").val("");
    }
    function retentionTotals(){
        $("#total_retention_html").html("$ " + total_retention.toFixed(2));
        $("#total_retention").val(total_retention.toFixed(2));

        //$("#total_document").val(total);
        //$("#tax_iva").val(tax_iva);
    }
    function deleteRetention(index){

    total_retention = total_retention-totalRetention[index];

        $("#total_retention_html").html("$ " + total_retention.toFixed(2));
        $("#total_retention").val(total_retention.toFixed(2));

        $("#row" + index).remove();
    }
</script>
