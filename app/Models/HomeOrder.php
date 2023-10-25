<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HomeOrder extends Model
{
    use HasFactory;

    public $table = 'home_orders';

    protected $primaryKey = 'id';

    public $timestamps = true;

    protected $fillable = [
        'name',
        'address',
        'phone',
        'domiciliary',
        'domicile_value',
        'time_receipt',
        'time_sent',
        'order_id'
    ];

    protected $guarded = [
        'id'
    ];

    public function restaurantOrder()
    {
        return $this->belongsTo(RestaurantOrder::class);
    }
}
