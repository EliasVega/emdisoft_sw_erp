<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class NdpurchaseProduct extends Model
{
    use HasFactory;

    public $table = 'ndpurchase_products';

    protected $primaryKey = 'id';

    public $timestamps = true;

    protected $fillable = [
        'quantity',
        'price',
        'tax_rate',
        'subtotal',
        'tax_subtotal',
        'ncpurchase_id',
        'product_id'
    ];

    protected $guarded = [
        'id'
    ];



    public function ndpurchase(){
        return $this->hasOne(Ndpurchase::class);
    }

    public function product(){
        return $this->belongsTo(Product::class);
    }

}
