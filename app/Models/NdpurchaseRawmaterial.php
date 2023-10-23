<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NdpurchaseRawmaterial extends Model
{
    use HasFactory;
    public $table = 'ndpurchase_rawmaterials';

    protected $primaryKey = 'id';

    public $timestamps = true;

    protected $fillable = [
        'quantity',
        'price',
        'tax_rate',
        'subtotal',
        'tax_subtotal',
        'ncpurchase_id',
        'raw_material_id'
    ];

    protected $guarded = [
        'id'
    ];

    public function ndpurchase(){
        return $this->hasOne(Ndpurchase::class);
    }

    public function rawMaterial(){
        return $this->belongsTo(RawMaterial::class);
    }
}
