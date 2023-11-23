<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductRestaurantOrder extends Model
{
    use HasFactory;

    public $table = 'product_restaurant_orders';

    protected $primaryKey = 'id';

    public $timestamps = true;

    protected $fillable = [
        'referency',
        'quantity',
        'price',
        'tax_rate',
        'subtotal',
        'tax_subtotal',
        'edition',
        'status',

        'restaurant_order_id',
        'product_id',
    ];
    public function restaurantOrder(){
        return $this->belongsTo(RestaurantOrder::class);
    }

    public function product(){
        return $this->belongsTo(Product::class);
    }
}
