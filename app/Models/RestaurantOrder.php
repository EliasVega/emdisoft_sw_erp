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

        'branch_id',
        'cash_register_id',
        'invoice_id',
        'restaurant_table_id',
        'user_id',
        'customer_home_id',
        'customer_id'
    ];

    protected $guarded = [
        'id'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function branch(){
        return $this->belongsTo(Branch::class);
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

    public function cashRegister(){
        return $this->belongsTo(CashRegister::class);
    }

    public function customer(){
        return $this->belongsTo(Customer::class);
    }

    public function customerHome(){
        return $this->belongsTo(CustomerHome::class);
    }
}
