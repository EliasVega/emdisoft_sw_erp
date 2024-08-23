<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerHome extends Model
{
    use HasFactory;

    public $table = 'customer_homes';

    protected $primaryKey = 'id';

    public $timestamps = true;

    protected $fillable = [
        'name',
        'address',
        'phone', 12
    ];

    protected $guarded = [
        'id'
    ];

    public function restaurantOrders()
    {
        return $this->hasMany(RestaurantOrder::class);
    }

}
