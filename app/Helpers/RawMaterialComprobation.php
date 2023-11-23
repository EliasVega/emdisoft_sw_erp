<?php

use App\Models\Product;
use App\Models\RawMaterial;

if (! function_exists('raw_material_comprobation')) {
    function raw_material_comprobation($request)
    {
        $product_id = $request->product_id;//obteniendo el producto
        $quantity = $request->quantity;//cantidad de productos
        $ref = $request->ref;//obteniendo la referencia asignada al producto
        //variables de materias primas
        $raw_material_id = $request->raw_material_id;//obteniendo el id de la materia prima
        $quantityrm = $request->quantityrm;//obteniendo la cantidad de materia primas
        $material = $request->material;//nombre de la materia prima
        $referency = $request->referency;//obteniendo la referencia producto en la materia prima
        $rawMaterials[] = [];//array de las materias primas reales
        $contRM = 0;//contador para el array de $rawMaterials

        for ($i=0; $i < count($raw_material_id); $i++) {

            $quantityPro = 0;
            $idProd = 0;
            for ($x=0; $x < count($product_id); $x++) {
                if ($referency[$i] == $ref[$x]) {
                    $quantityPro = $quantity[$x];
                    $idProd = $product_id[$x];
                }
            }

            $quantityProRm = $quantityPro * $quantityrm[$i];

            if ($rawMaterials[0] != []) {//si aun no hay registro en el array $rawMaterials
                $contsi = 0;//contador para saber si existe esa materia prima
                foreach ($rawMaterials as $key => $rawMaterial) {//recorriendo el array $rawMaterials
                    if ($rawMaterial[0] == $raw_material_id[$i]) {//si ya existe en el array esa materia prima
                        $rawMaterial[1] += $quantityProRm;//le suma la nueva cantidad
                        $contsi++;//aumenta el contador para decir que este producto ya esta sumado
                        $rawMaterials[$key] = $rawMaterial;//actualiza el array $rawMaterials
                    }
                }
                if ($contsi == 0) {//si contador es igual a 0 quiere decir que no existia la materia prima
                    //si no existe la materia prima crea una nueva linea en el array $rawMaterials
                    $rawMaterials[$contRM] = [$raw_material_id[$i], $quantityProRm, $material[$i]];
                        $contRM++;//aumenta el contador de lineas del array $rawMaterials
                }
            } else {//si no hay ningun dato en el array crea la primera linea
                $rawMaterials[$contRM] = [$raw_material_id[$i], $quantityProRm, $material[$i]];
                $contRM++;

            }
        }
        //metodo que verifica si hay suficiente materias primas para esta comanda
        for ($i=0; $i < count($rawMaterials); $i++) {

            $rawMaterialId = $rawMaterials[$i][0];
            $quantityRawmaterial = $rawMaterials[$i][1];
            $nameRawmaterial = $rawMaterials[$i][2];
            $rawMaterial = RawMaterial::findOrFail($rawMaterialId);
            $stock = $rawMaterial->stock;
            $product = Product::findOrFail($idProd);
            $nameProduct = $product->name;
            if ($quantityRawmaterial > $stock && $rawMaterial->type_product == 'product') {
                toast("$nameRawmaterial" . ' ' . 'no es suficiente para' . ' ' . "$nameProduct",'warning');
                //Alert::success('Error', "$nameProduct" . ' ' . 'no es suficiente para' . ' ' . "$nameMenu");
                return redirect()->back();
            }
        }
    }
}
