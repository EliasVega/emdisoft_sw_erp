<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductRemission extends Model
{
    use HasFactory;

    public $table = 'product_remissions';

    protected $primaryKey = 'id';

    public $timestamps = true;

    protected $fillable = [
        'quantity',
        'price',
        'tax_rate',
        'subtotal',
        'iva_subtotal',

        'remission_id',
        'product_id'
    ];
    public function remission(){
        return $this->belongsTo(Remission::class);
    }

    public function product(){
        return $this->belongsTo(Product::class);
    }
}
