<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PurchaseOrderProduct extends Model
{
    use HasFactory;

    public $table = 'purchase_order_products';

    protected $primaryKey = 'id';

    public $timestamps = true;

    protected $fillable = [
        'quantity',
        'price',
        'tax_rate',
        'subtotal',
        'tax_subtotal',

        'purchase_order_id',
        'product_id'
    ];
    public function purchaseOrder(){
        return $this->belongsTo(PurchaseOrder::class);
    }

    public function product(){
        return $this->belongsTo(Product::class);
    }
}
