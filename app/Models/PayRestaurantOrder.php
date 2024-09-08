<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PayRestaurantOrder extends Model
{
    use HasFactory;

    public $table = 'pay_restaurant_orders';

    protected $primaryKey = 'id';

    public $timestamps = true;

    protected $fillable = [
        'pay',
        'transaction',

        'restaurant_order_id',
        'user_id',
        'payment_form_id',
        'payment_method_id',
        'bank_id',
        'card_id'
    ];

    protected $guarded = [
        'id'
    ];

    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function paymentMethods()
    {
        return $this->hasMany(PaymentMethod::class);
    }

    public function paymentForm(){
        return $this->belongsTo(PaymentForm::class);
    }

    public function bank(){
        return $this->belongsTo(PaymentForm::class);
    }

    public function card(){
        return $this->belongsTo(PaymentForm::class);
    }
    
}
