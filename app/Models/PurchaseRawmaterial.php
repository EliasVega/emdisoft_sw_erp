<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PurchaseRawmaterial extends Model
{
    use HasFactory;

    public $table = 'purchase_rawmaterials';

    protected $primaryKey = 'id';

    public $timestamps = true;

    protected $fillable = [
        'quantity',
        'price',
        'tax_rate',
        'subtotal',
        'iva_subtotal',

        'purchase_id',
        'raw_material_id'
    ];
    public function purchase(){
        return $this->belongsTo(Purchase::class);
    }

    public function rawMaterial(){
        return $this->belongsTo(RawMaterial::class);
    }
}
