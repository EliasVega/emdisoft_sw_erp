<?php
namespace App\Traits;

use App\Models\BranchProduct;
use App\Models\Indicator;

trait InventoryInvoices {
    public function inventoryInvoices($product, $branchProducts, $quantityLocal, $branch){

        $indicator = Indicator::findOrFail(1);
        if ($product->type_product == 'product') {//si el producto es typo producto
            if ($indicator->inventory == 'on') {//si se maneja inventario
                $product->stock -= $quantityLocal;
                $product->update();

                $branchProducts->stock -= $quantityLocal;
                $branchProducts->update();
            }
        } else if ($product->type_product == 'consumer') {//si el producto es typo consumer
            if ($indicator->inventory == 'on') {//si se maneja inventario
                $product->stock += $quantityLocal;
                $product->update();

                //Actualizando o creando productos en determinada sucursal
                if (isset($branchProducts)) {
                    //metodo para actualizar el producto en la sucursal stock
                    $branchProducts->stock += $quantityLocal;
                    $branchProducts->update();
                } else {
                    //metodo para crear el producto en la sucursal y asignar stock
                    $branchProduct = new BranchProduct();
                    $branchProduct->branch_id = current_user()->branch_id;
                    $branchProduct->product_id = $product->id;
                    $branchProduct->stock = $quantityLocal;
                    $branchProduct->order_product = 0;
                    $branchProduct->save();
                }
            }
        } else { // si el producto es de tipo servicio
            if ($indicator->inventory == 'on') {
                //Actualizar stock y precio del producto
                $product->stock += $quantityLocal;
                $product->update();

                //Actualizando o creando productos en determinada sucursal
                if (isset($branchProducts)) {
                    //metodo para actualizar el producto en la sucursal stock
                    $branchProducts->stock += $quantityLocal;
                    $branchProducts->update();
                } else {
                    //metodo para crear el producto en la sucursal y asignar stock
                    $branchProduct = new BranchProduct();
                    $branchProduct->branch_id = current_user()->branch_id;
                    $branchProduct->product_id = $product->id;
                    $branchProduct->stock = $quantityLocal;
                    $branchProduct->order_product = 0;
                    $branchProduct->save();
                }
            }
        }

    }
}
