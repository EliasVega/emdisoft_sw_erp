<?php
namespace App\Traits;

use App\Models\BranchRawmaterial;
use App\Models\Indicator;

trait RawMaterialPurchases {
    public function rawMaterialPurchases($product, $branchRawmaterials, $quantity, $price, $branch){

        $indicator = Indicator::findOrFail(1);
        if ($product->type_product == 'product') {
            if ($indicator->inventory == 'on') {
                    //Actualizar stock y precio del producto
                    $product->stock += $quantity; //reempazando triguer
                    $product->price = $price;
                    $product->update();

                //Actualizando o creando productos en determinada sucursal
                if (isset($branchProducts)) {
                    //metodo para actualizar el producto en la sucursal stock
                    $branchProducts->stock += $quantity;
                    $branchProducts->update();
                } else {
                    //metodo para crear el producto en la sucursal y asignar stock
                    $branchRawmaterials = new BranchRawmaterial();
                    $branchRawmaterials->branch_id = $branch;
                    $branchRawmaterials->raw_material_id = $product->id;
                    $branchRawmaterials->stock += $quantity;
                    $branchRawmaterials->save();
                }
            }
        } else {
            if ($indicator->inventory == 'on') {
                //Actualizar stock y precio del producto
                $product->stock += $quantity;
                $product->price = $price;
                $product->update();

                //Actualizando o creando productos en determinada sucursal
                if (isset($branchRawmaterials)) {
                    //metodo para actualizar el producto en la sucursal stock
                    $branchRawmaterials->stock += $quantity;
                    $branchRawmaterials->update();
                } else {
                    //metodo para crear el producto en la sucursal y asignar stock
                    $branchRawmaterials = new BranchRawmaterial();
                    $branchRawmaterials->branch_id = $branch;
                    $branchRawmaterials->product_id = $product->id;
                    $branchRawmaterials->stock += $quantity;
                    $branchRawmaterials->save();
                }
            }
        }
    }
}
