<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NcpurchaseProduct extends Model
{
    use HasFactory;

    public $table = 'ncpurchase_products';

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



    public function ncpurchase(){
        return $this->hasOne(Ncpurchase::class);
    }

    public function product(){
        return $this->belongsTo(Product::class);
    }
}
