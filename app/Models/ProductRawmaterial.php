<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductRawmaterial extends Model
{
    use HasFactory;

    public $table = 'product_rawmaterials';

    protected $primaryKey = 'id';

    public $timestamps = true;

    protected $fillable = [
        'quantity',
        'consumer_price',
        'subtotal',

        'product_id',
        'raw_material_id'
    ];

    protected $guarded = [
        'id'
    ];

    public function product(){
        return $this->belongsTo(Product::class);
    }

    public function rawMaterial(){
        return $this->hasOne(RawMaterial::class);
    }
}
