<?php
namespace App\Traits;

use App\Models\CommandRawmaterial;

trait CommandRawMaterialCreate {
    public function commandRawMaterialCreate($quantityRawmaterial, $referencyrm, $statusrm, $roId, $pId, $rmId){
        //funcion para crear registro de novedades de materia prima en la comanda

        $commandRawmaterial = new CommandRawmaterial();
        $commandRawmaterial->quantity = $quantityRawmaterial;
        $commandRawmaterial->referency = $referencyrm;
        $commandRawmaterial->status = $statusrm;
        $commandRawmaterial->restaurant_order_id = $roId;
        $commandRawmaterial->product_id = $pId;
        $commandRawmaterial->raw_material_id = $rmId;
        $commandRawmaterial->save();
    }
}
