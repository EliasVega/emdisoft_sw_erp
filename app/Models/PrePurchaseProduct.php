<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PrePurchaseProduct extends Model
{
    use HasFactory;

    public $table = 'pre_purchase_products';

    protected $primaryKey = 'id';

    public $timestamps = true;

    protected $fillable = [
        'quantity',
        'price',
        'tax_rate',
        'subtotal',
        'iva_subtotal',

        'pre_purchase_id',
        'product_id'
    ];
    public function prePurchase(){
        return $this->belongsTo(PrePurchase::class);
    }

    public function product(){
        return $this->belongsTo(Product::class);
    }
}
