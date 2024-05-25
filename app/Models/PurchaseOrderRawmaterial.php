<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PurchaseOrderRawmaterial extends Model
{
    use HasFactory;

    public $table = 'purchase_order_rawmaterials';

    protected $primaryKey = 'id';

    public $timestamps = true;

    protected $fillable = [
        'quantity',
        'price',
        'tax_rate',
        'subtotal',
        'tax_subtotal',

        'purchase_order_id',
        'raw_material_id'
    ];
    public function purchaseOrder(){
        return $this->belongsTo(PurchaseOrder::class);
    }

    public function rawMaterial(){
        return $this->belongsTo(RawMaterial::class);
    }
}
