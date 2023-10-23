<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RestaurantTable extends Model
{
    use HasFactory;

    public $table = 'restaurant_tables';

    protected $primaryKey = 'id';

    public $timestamps = true;

    protected $fillable = [
        'name',
        'branch_id'
    ];

    protected $guarded = [
        'id'
    ];

    public function branch(){
        return $this->belongsTo(Branch::class);
    }

    public function restaurantOrders(){
        return $this->hasMany(RestaurantOrder::class);
    }

    public function invoices(){
        return $this->hasMany(Invoices::class);
    }
}
