<script>
    /*$(document).ready(function(){
            alert('estoy funcionando correctamanete empresa');
        });*/

    $("#fPercentage").hide();
    $("#ndinvoiceretention").hide();
    $("#infoIva").hide();
    $("#infoType").hide();

    var totalRetention=[];
    var contRetention=0;
    var total_retention = 0;
    var iva = 0;

    function retentionLoad(){
        tax = {!! json_encode($taxes) !!};
        tax.forEach((value, i) => {
            if (value['tax_value'] > 0) {

                companyTaxId = value['id'],
                taxName= value['name'];
                taxValue= value['tax_value'];
                taxTypeid = value['tax_type_id'];

                if(taxName!='', taxValue!="" && taxValue>0){
                    if (taxTypeid == 5) {
                        totalRetention[contRetention] = iva * percentage/100;
                    } else {
                        totalRetention[contRetention] = total_ndinvoice * percentage/100;
                    }
                    totalRetention[contRetention] = taxValue;
                    total_retention = parseFloat(total_retention)  + parseFloat(totalRetention[contRetention]);
                    var rowretention= '<tr class="selected" id="rowretention'+contRetention+'"><td><button type="button" class="btn btn-danger btn-sm" onclick="deleterow('+contRetention+');"><i class="fa fa-times"></i></button></td><td><input type="hidden" name="company_tax_id[]" value="'+companyTaxId+'">'+companyTaxId+'</td><td><input type="hidden" name="tax[]" value="'+taxName+'">'+taxName+'</td><td> $'+parseFloat(totalRetention[contRetention]).toFixed(2)+'</td></tr>';
                    contRetention++;

                    retentionTotals();
                    $('#retentions').append(rowretention);
                    clean();
                }else{
                    //alert("Rellene todos los campos del detalle para esta venta");
                    Swal.fire({
                    type: 'error',
                    //title: 'Oops...',
                    text: 'Rellene todos los campos del detalle para esta venta',
                    })
                }
            }
        });
    }
    function retentionUpdate(){

        tax = {!! json_encode($taxes) !!};
        tax.forEach((value, i) => {
            if (value['tax_value'] > 0) {

                companyTaxId = value['id'],
                taxName= value['name'];
                taxValue= value['tax_value'];
                taxTypeid = value['tax_type_id'];
                percentage = value['percentage'];

                iva = $("#tax_iva").val();
                total_ndinvoice = $("#total_ndinvoice").val();
                if(taxName!='', companyTaxId!=''){
                    if (taxTypeid == 5) {
                        totalRetention[contRetention] = iva * percentage/100;
                    } else {
                        totalRetention[contRetention] = total_ndinvoice * percentage/100;
                    }
                    //totalRetention[contRetention] = taxValue;
                    total_retention = parseFloat(total_retention)  + parseFloat(totalRetention[contRetention]);
                    var rowretention= '<tr class="selected" id="rowretention'+contRetention+'"><td><button type="button" class="btn btn-danger btn-sm" onclick="deleterow('+contRetention+');"><i class="fa fa-times"></i></button></td><td><input type="hidden" name="company_tax_id[]" value="'+companyTaxId+'">'+companyTaxId+'</td><td><input type="hidden" name="tax[]" value="'+taxName+'">'+taxName+'</td><td> $'+parseFloat(totalRetention[contRetention]).toFixed(2)+'</td></tr>';
                    contRetention++;

                    retentionTotals();
                    $('#retentions').append(rowretention);
                    //clean();
                }else{
                    //alert("Rellene todos los campos del detalle para esta venta");
                    Swal.fire({
                    type: 'error',
                    //title: 'Oops...',
                    text: 'Rellene todos los campos del detalle para esta venta',
                    })
                }
            }
        });
    }

    function retentionTotals(){
        $("#total_retention_html").html("$ " + total_retention.toFixed(2));
        $("#total_retention").val(total_retention.toFixed(2));
    }

    function deleteRetention(index){
        total_retention = total_retention - totalRetention[index];

        $("#total_retention_html").html("$ " + total_retention.toFixed(2));
        $("#total_retention").val(total_retention.toFixed(2));

        $("#rowretention" + index).remove();
    }

    function clearRetention(){
        for (let index = 0; index < contRetention; index++) {
            total_retention = total_retention-totalRetention[index];

            $("#total_retention_html").html("$ " + total_retention.toFixed(2));
            $("#total_retention").val(total_retention.toFixed(2));

            $("#rowretention" + index).remove();
        }
        contRetention = 0;
    }

    function retentionClear(){

        tax = {!! json_encode($taxes) !!};
        tax.forEach((value, i) => {
            deleteRetention(i);

        });
    }

    /*
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
        total_ndinvoice = $("#total_ndinvoice").val();

        ttid = $("#taxTypeId").val();
        iva = $("#tax_iva").val();

        if(company_tax_id !="" && companyTax!="" && percentage!=""  && percentage>0 ){
            if (ttid == 5) {
                totalRetention[contRetention] = iva * percentage/100;
            } else {
                totalRetention[contRetention] = total_ndinvoice * percentage/100;
            }
            total_retention = total_retention+totalRetention[contRetention];
            var row= '<tr class="selected" id="row'+contRetention+'"><td><button type="button" class="btn btn-danger btn-sm" onclick="deleterow('+contRetention+');"><i class="fa fa-times"></i></button></td><td><input type="hidden" name="company_tax_id[]" value="'+company_tax_id+'">'+companyTax+'</td><td> $'+parseFloat(totalRetention[contRetention]).toFixed(2)+'</td></tr>';
            contRetention++;

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
    }*/
</script>
