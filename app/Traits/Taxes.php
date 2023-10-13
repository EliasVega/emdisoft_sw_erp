<?php
namespace App\Traits;

use App\Models\CompanyTax;
use App\Models\Product;

trait Taxes {
    public function getTaxesLine($request,){

        $quantity = $request->quantity;
        $price = $request->price;
        $product_id = $request->id;
        $tax_rate = $request->tax_rate;

        $taxes[] = [];
        $contax = 0;
        for ($i=0; $i < count($product_id); $i++) {
            $id = $product_id[$i];
            $product = Product::findOrFail($id);

            $companyTaxProduct = $product->category->company_tax_id;
            $companyTax = CompanyTax::findOrFail($companyTaxProduct);
            $taxAmount = ($quantity[$i] * $price[$i] * $tax_rate[$i])/100;
            $amount = $quantity[$i] * $price[$i];
            $taxRate = $tax_rate[$i];

            if ($taxAmount > 0) {


                if ($taxes[0] != []) { //contax > 0
                    $contsi = 0;
                    foreach ($taxes as $key => $tax) {

                        if ($tax[0] == $companyTaxProduct) {
                            //$taxes[$key][2] += $productPurchase->tax_subtotal;
                            $tax[2] += $taxAmount;
                            $tax[3] += $amount;
                            $contsi++;
                            $taxes[$key] = $tax;
                        }
                    }
                    if ($contsi == 0) {
                        $taxes[$contax] = [$companyTax->id, $companyTax->tax_type_id, $taxAmount, $amount, $taxRate];
                            $contax++;
                    }
                } else {
                    //$taxes[$contax] = [$companyTaxProduct, $productPurchase->tax_rate, $productPurchase->tax_subtotal];
                    $taxes[$contax] = [$companyTax->id, $companyTax->tax_type_id, $taxAmount, $amount, $taxRate];
                    $contax++;
                }
            }
        }

        return $taxes;
    }
}
