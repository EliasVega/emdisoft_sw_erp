<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentForm extends Model
{
    use HasFactory;

    public $table = 'payment_forms';

    protected $primaryKey = 'id';

    public $timestamps = false;

    protected $fillable = [
        'name'
    ];

    protected $guarded = [
        'id'
    ];
    /*
    public function invoices(){
        return $this->hasMany(Invoice::class);
    }

    public function payOrders(){
        return $this->belongsToMany(Pay_order::class);
    }

    public function payEvents(){
        return $this->belongsToMany(Pay_event::class);
    }

    public function orders(){
        return $this->hasMany(Order::class);
    }*/

    public function purchases(){
        return $this->hasMany(Purchase::class);
    }

}
