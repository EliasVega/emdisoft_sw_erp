<script>
    /*$(document).ready(function(){
            alert('estoy funcionando correctamanete empresa');
        });*/

    jQuery(document).ready(function($){
        $(document).ready(function() {
            $('#raw_material_id').select2({
                theme: "classic",
                width: "100%",
            });
        });
    });
    let  contrm = 0;
    let  totalrm = 0;
    let subtotalrm = [];
    let refCont = [];
    let rmpartial = [];
    let contrmpartial = 0;
    //let totalrm_tax = 0;
    //let tax_ratecont = [];
    //form Order
    $("#editMaterialId").hide();
    $("#idProductRaw").hide();
    $("#save").hide();
    $("#noLook").hide();

    $("#raw_material_id").change(rawMaterialValue);

    function rawMaterialValue(){
        dataMaterial = document.getElementById('raw_material_id').value.split('_');
        $("#consumer_price").val(dataMaterial[1]);
        $("#referency").val(cont - 1);
    }

    $(document).ready(function(){
        $("#addrm").click(function(){
            addrm();
        });
    });
    function addrm(){
        raw_material_id = dataMaterial[0];
        material = $("#raw_material_id option:selected").text();
        quantityrm = $("#quantityrm").val();
        consumer_price = $("#consumer_price").val();
        idP = $("#idProduct").val();
        referency = $("#referency").val();
        if(raw_material_id !="" && material!="" && quantityrm!="" && quantityrm>0 && consumer_price!="" && consumer_price>0){
            subtotalrm[contrm]= parseFloat(quantityrm) * parseFloat(consumer_price);
            totalrm = totalrm+subtotalrm[contrm];

            subcont = subtotalrm[contrm];
            rowRawMaterial(contrm, referency, idP, raw_material_id, material, quantityrm, consumer_price, subcont);
            contrm++;
            totalrms();
            $('#materials').append(rowrm);
            clear();
            assess();
        } else {
            //alert("Rellene todos los campos del detalle de la venta");
            Swal.fire({
            type: 'error',
            //title: 'Oops...',
            text: 'Rellene todos los campos',
            });
        }
    }

    $("#product_id").change(function(event){

        $.get("getRawMaterial/" + event.target.value + "", function(response){
            deletePartial();
            $("#material_id").empty();
            $("#material_id").append("<option value = '#' disabled selected>Seleccionar ...</option>");

            for(i = 0; i < response.length; i++){

                idP = response[i].idP;
                raw_material_id = response[i].id;
                material= response[i].name;
                quantityrm= response[i].quantityrm;
                consumer_price= response[i].consumer_price;
                referency = cont;
                ed = 1;//para saber si es editado o nuevo
                if(raw_material_id !="" && quantityrm!="" && quantityrm>0  && consumer_price!="" && consumer_price>0){
                    subtotalrm[contrm]= parseFloat(quantityrm) * parseFloat(consumer_price);
                    totalrm = totalrm+subtotalrm[contrm];
                    refCont[contrm] = [contrm, referency];
                    subcont = subtotalrm[contrm];
                    rmpartial[contrmpartial] = [contrm, referency, idP, raw_material_id, material, quantityrm, consumer_price, subcont];
                    contrmpartial++;
                    contrm++;
                    //rowRawMaterial(contrm, referency, idP, raw_material_id, material, quantityrm, consumer_price, subcont);
                    //contrm++

                    //totalrms();
                    //$('#materials').append(rowrm);
                    //clear();
                    //$('#product_id option:selected').remove();
                }else{
                    //alert("Rellene todos los campos del detalle para esta compra");
                    Swal.fire({
                    type: 'error',
                    //title: 'Oops...',
                    text: 'Rellene todos los campos del detalle para esta compra',
                    })
                }
            }
            //$("#raw_material_id").selectpicker('refresh');
        });
    });

    function deletePartial () {
        rmpartial = [];
        contrmpartial = 0;
    }
    function insertrm() {

        for (let i = 0; i < rmpartial.length; i++) {
            rowRawMaterial(rmpartial[i][0], rmpartial[i][1], rmpartial[i][2], rmpartial[i][3], rmpartial[i][4], rmpartial[i][5], rmpartial[i][6], rmpartial[i][7]);

            totalrms();
            $('#materials').append(rowrm);

        }
        rmpartial = [];
        contrmpartial = 0;

    }

    jQuery(document).on("click", "#editrowrm", function () {
        editrowrm();
    });

    function editrowrm(index) {

        //$("#contrmMod").hide();
        //$("#subtotalrmMod").hide();
        //$("#idpMod").hide();

        // Obtener la fila
        var rowrm = $("#rowrm" + index);
        // Solo si la fila existe
        if(rowrm) {

            // Buscar datos en la fila y asignar a campos del formulario:
            // Primera columna (0) tiene ID, segunda (1) tiene nombre, tercera (2) capacidad
            $("#contrmModal").val(index);
            $("#idpModal").val(rowrm.find("td:eq(3)").text());
            $("#raw_material_idModal").val(rowrm.find("td:eq(4)").text());
            $("#rawMaterialModal").val(rowrm.find("td:eq(5)").text());
            $("#quantityrmModal").val(rowrm.find("td:eq(6)").text());
            $("#consumer_priceModal").val(rowrm.find("td:eq(7)").text());
            $("#subtotalrmModal").val(rowrm.find("td:eq(8)").text());

            // Mostrar modal
            $('#modalRawMaterial').modal('show');
        }
    }

    jQuery(document).on("click", "#updateRawMaterial", function () {
        updaterowrm();
    });

    function updaterowrm() {

        // Buscar datos en la fila y asignar a campos del formulario:
        // Primera columna (0) tiene ID, segunda (1) tiene nombre, tercera (2) capacidad
        conteditrm = $("#contrmModal").val();
        //id = $("#idModal").val();
        raw_material_id = $("#raw_material_idModal").val();
        material = $("#rawMaterialModal").val();
        quantityrm = $("#quantityrmModal").val();
        consumer_price = $("#consumer_priceModal").val();
        idP = $("#idpModal").val();
        referency = cont -1;
        ed = 1;
        //$('#priceModal').prop("readonly", false)
        if(raw_material_id !="" && quantityrm!="" && quantityrm>0 && consumer_price!="" && consumer_price>0){
            subtotalrm[contrm]= parseFloat(quantityrm) * parseFloat(consumer_price);
            totalrm = totalrm + subtotalrm[contrm];
            subcont = subtotalrm[contrm];
            rowRawMaterial(contrm, referency, idP, raw_material_id, material, quantityrm, consumer_price, subcont);
            contrm++;
            deleterowrm(conteditrm);
            totalrms();
            clear();
            $('#materials').append(rowrm);
            $('#modalRawMaterial').modal('hide');
            //$('#product_id option:selected').remove();
            clear();
        }else{
            // alert("Rellene todos los campos del detalle de la compra, revise los datos del producto");
            Swal.fire({
                type: 'error',
                //title: 'Oops...',
                text: 'Rellene todos los campos del detalle de la compra',
            })
        }
    }

    function totalrms(){
        $("#totalrm_html").html("$ " + totalrm.toFixed(2));
        $("#totalrm").val(totalrm.toFixed(2));
    }
    function clear(){
        $('#raw_material_id').val(null).trigger('change');
        //$("#raw_material_id").val("");
        $("#quantityrm").val("");
        $("#consumer_price").val("");
    }

    function deleterowrm(index){
        totalrm -= parseFloat(subtotalrm[index]);

        $("#totalrm_html").html("$ " + totalrm.toFixed(2));
        $("#totalrm").val(totalrm.toFixed(2));

        $("#rowrm" + index).remove();
    }

    function deleteRawmaterials(referencyProduct) {
        for (let i = 0; i < refCont.length; i++) {
            if (refCont[i][1] == referencyProduct) {
                index = refCont[i][0]
                deleterowrm(index);
            }
        }
    }

    function rowRawMaterial(contrm, referency, idP, raw_material_id, material, quantityrm, consumer_price, subcont) {
        rowrm= '<tr class="selected" id="rowrm'+contrm+'"><td><button type="button" class="btn btn-danger btn-sm" onclick="deleterowrm('+contrm+');"><i class="fa fa-times"></i></button></td><td><button type="button" class="btn btn-warning btn-sm btnedit" onclick="editrowrm('+contrm+');"><i class="far fa-edit"></i></button></td><td><input type="hidden" name="referency[]" value="'+referency+'">'+referency+'</td><td><input type="hidden" name="idP[]" value="'+idP+'">'+idP+'</td> <td><input type="hidden" name="raw_material_id[]" value="'+raw_material_id+'">'+raw_material_id+'</td> <td><input type="hidden" name="material[]" value="'+material+'">'+material+'</td> <td><input type="hidden" name="quantityrm[]" value="'+quantityrm+'">'+quantityrm+'</td> <td><input type="hidden" name="consumer_price[]" value="'+consumer_price+'">'+consumer_price+'</td><td>$'+subcont+' </td></tr>';
    }
</script>
