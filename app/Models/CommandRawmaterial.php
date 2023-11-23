<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CommandRawmaterial extends Model
{
    use HasFactory;

    public $table = 'command_rawmaterials';

    protected $primaryKey = 'id';

    public $timestamps = true;

    protected $fillable = [
        'quantity',
        'restaurant_order_id',
        'product_id',
        'raw_material_id'
    ];

    protected $guarded = [
        'id'
    ];

    public function restaurantOrder()
    {
        return $this->belongsTo(RestaurantOrder::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function rawMaterial()
    {
        return $this->belongsTo(RawMaterial::class);
    }
}
