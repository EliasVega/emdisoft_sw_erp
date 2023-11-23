<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RawmaterialRestaurantorder extends Model
{
    use HasFactory;

    public $table = 'rawmaterial_restaurantorders';

    protected $primaryKey = 'id';

    public $timestamps = true;

    protected $fillable = [
        'referency',
        'quantity',
        'total_quantity',
        'restaurant_order_id',
        'raw_material_id',
        'product_id'
    ];

    protected $guarded = [
        'id'
    ];

    public function restaurantOrder()
    {
        return $this->belongsTo(RestaurantOrder::class);
    }

    public function rawMaterial()
    {
        return $this->belongsTo(RawMaterial::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
