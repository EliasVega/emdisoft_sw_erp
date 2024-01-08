<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentPaymentMethod extends Model
{
    use HasFactory;

    public $table = 'payment_payment_methods';

    protected $primaryKey = 'id';

    public $timestamps = true;

    protected $fillable = [
        'pay',
        'transaction',
        'payment_id',
        'payment_method_id',
        'bank_id',
        'card_id',
        'advance_id',
    ];

    protected $guarded = [
        'id'
    ];

    public function bank(){
        return $this->belongsTo(Bank::class);
    }

    public function card(){
        return $this->belongsTo(Card::class);
    }

    public function paymentMethod()
    {
        return $this->belongsTo(PaymentMethod::class);
    }

    public function payment()
    {
        return $this->belongsTo(payment::class);
    }

    public function advance()
    {
        return $this->belongsTo(Advance::class);
    }
}
