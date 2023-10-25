<?php
namespace App\Traits;

use App\Models\BranchProduct;
use App\Models\Indicator;

trait InventoryPurchases {
    public function inventoryPurchases($product, $branchProducts, $quantity, $price, $branch){

        $indicator = Indicator::findOrFail(1);
        if ($product->type_product == 'product') {
            if ($indicator->inventory == 'on') {
                if ($indicator->product_price == 'automatic') {
                    //Actualizar stock y precio del producto
                    $utility = $product->category->utility_rate;//valor registrado de utilidad
                    $priceOld = $product->price; //precio actual del producto
                    $stockardex = $product->stock; //stock actual del producto
                    //Actualizando el valor de venta del producto
                    $priceNew = (($stockardex * $priceOld) + ($quantity * $price)) / ($stockardex + $quantity);
                    $priceSale = $priceNew + ($priceNew * $utility / 100); //Actualizando el valor
                    //Actualizando los valores en los registros de la BD
                    $product->stock += $quantity; //reempazando triguer
                    $product->price = $priceNew;
                    $product->sale_price = $priceSale;
                    $product->update();

                } else {
                    //Actualizar stock y precio del producto
                    $product->stock += $quantity; //reempazando triguer
                    $product->price = $price;
                    $product->sale_price = $price;
                    $product->update();
                }


                //Actualizando o creando productos en determinada sucursal
                if (isset($branchProducts)) {
                    //metodo para actualizar el producto en la sucursal stock
                    $branchProducts->stock += $quantity;
                    $branchProducts->update();
                } else {
                    //metodo para crear el producto en la sucursal y asignar stock
                    $branchProduct = new BranchProduct();
                    $branchProduct->branch_id = $branch;
                    $branchProduct->product_id = $product->id;
                    $branchProduct->stock += $quantity;
                    $branchProduct->save();
                }
            }
        } else {
            if ($indicator->inventory == 'on') {
                //Actualizar stock y precio del producto
                $product->stock += $quantity;
                $product->price = $price;
                $product->sale_price = $price;
                $product->update();

                //Actualizando o creando productos en determinada sucursal
                if (isset($branchProducts)) {
                    //metodo para actualizar el producto en la sucursal stock
                    $branchProducts->stock += $quantity;
                    $branchProducts->update();
                } else {
                    //metodo para crear el producto en la sucursal y asignar stock
                    $branchProduct = new BranchProduct();
                    $branchProduct->branch_id = $branch;
                    $branchProduct->product_id = $product->id;
                    $branchProduct->stock += $quantity;
                    $branchProduct->save();
                }
            }
        }
    }
}
