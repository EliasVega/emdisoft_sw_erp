<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    use HasFactory;

    public $table = 'expenses';

    protected $primaryKey = 'id';

    public $timestamps = true;

    protected $fillable = [
        'document',
        'generation_date',
        'total',
        'total_tax',
        'total_pay',
        'pay',
        'balance',
        'grand_total',
        'note',
        'user_id',
        'branch_id',
        'provider_id',
        'payment_form_id',
        'payment_method_id',
        'voucher_type_id',
    ];

    protected $guarded = [
        'id'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function third(){
        return $this->belongsTo(Provider::class, 'provider_id');
    }

    public function branch(){
        return $this->belongsTo(Branch::class);
    }

    public function productExpenses(){
        return $this->hasMany(ProductPurchase::class);
    }

    public function voucherTipe()
    {
        return $this->belongsTo(Voucher_type::class);
    }

    public function paymentForm(){
        return $this->belongsTo(PaymentForm::class);
    }

    public function paymentMethod(){
        return $this->belongsTo(PaymentMethod::class);
    }
    //Relacion polimorfica con el pago
    public function pays()
    {
        return $this->morphMany(pay::class, 'payable');
    }
}
