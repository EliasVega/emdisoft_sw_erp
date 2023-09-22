<script>
    /*
    $(document).ready(function(){
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

    $("#fPercentage").hide();
    $("#purchase").hide();
    $("#infoIva").hide();
    $("#infoType").hide();

    var subtotalRetention=[];
    var contRetention=0;
    var total_retention = 0;
    var iva = 0;

    //seleccionar de acuerdo ala retencion
    $("#company_tax_id").change(taxCompany);

    function taxCompany(){
        dataTax = document.getElementById('company_tax_id').value.split('_');
        $("#percentage").val(dataTax[1]);
        $("#taxTypeId").val(dataTax[2]);
    }
    $(document).ready(function(){
        $("#withhold").click(function(){
            withhold();
        });
    });
    function withhold(){

        dataTax = document.getElementById('company_tax_id').value.split('_');
        company_tax_id= dataTax[0];
        companyTax= $("#company_tax_id option:selected").text();
        percentage = $("#percentage").val();
        total_ncpurchase = $("#total_ncpurchase").val();

        ttid = $("#taxTypeId").val();
        iva = $("#tax_iva").val();

        if(company_tax_id !="" && companyTax!="" && percentage!=""  && percentage>0 ){
            if (ttid == 5) {
                subtotalRetention[contRetention] = iva * percentage/100;
            } else {
                subtotalRetention[contRetention] = total_ncpurchase * percentage/100;
            }
            total_retention = total_retention+totalRetention[contRetention];
            var row= '<tr class="selected" id="row'+contRetention+'"><td><button type="button" class="btn btn-danger btn-sm" onclick="deleteRetention('+contRetention+');"><i class="fa fa-times"></i></button></td><td><input type="hidden" name="company_tax_id[]" value="'+company_tax_id+'">'+companyTax+'</td><td> $'+parseFloat(totalRetention[contRetention]).toFixed(2)+'</td></tr>';
            contRetention++;

            retentionTotals();
            $('#retentions').append(row);
            $('#company_tax_id option:selected').remove();
            retentionClear();
        } else {
            //alert("Rellene todos los campos del detalle de la venta");
            Swal.fire({
            type: 'error',
            //title: 'Oops...',
            text: 'Rellene todos los campos del detalle del Apago',
            });
        }
    }
    function retentionClear(){
        $("#company_tax_id").val("");
        $("#percentage").val("");
    }
    function retentionTotals(){
        $("#total_retention_html").html("$ " + total_retention.toFixed(2));
        $("#total_retention").val(total_retention.toFixed(2));
    }
    function deleteRetention(index){

    total_retention = total_retention-totalRetention[index];

        $("#total_retention_html").html("$ " + totalpay.toFixed(2));
        $("#total_retention").val(total_retention.toFixed(2));

        $("#row" + index).remove();
    }
</script>
