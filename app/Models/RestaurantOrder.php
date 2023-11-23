<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RestaurantOrder extends Model
{
    use HasFactory;

    public $table = 'restaurant_orders';

    protected $primaryKey = 'id';

    public $timestamps = true;

    protected $fillable = [
        'total',
        'total_tax',
        'total_pay',
        'status',
        'user_id',
        'restaurant_table_id',
        'invoice_id'
    ];

    protected $guarded = [
        'id'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function invoice()
    {
        return $this->belongsTo(Invoice::class);
    }

    public function restaurantTable()
    {
        return $this->belongsTo(RestaurantTable::class);
    }

    public function homeOrder()
    {
        return $this->hasOne(HomeOrder::class);
    }

    public function commandRawmaterials(){
        return $this->hasMany(CommandRawmaterial::class);
    }
}
