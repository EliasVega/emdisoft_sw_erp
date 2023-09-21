<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentMethod extends Model
{
    use HasFactory;

    public $table = 'payment_methods';

    protected $primaryKey = 'id';

    public $timestamps = false;

    protected $fillable = [
        'code',
        'name',
        'status'
    ];

    protected $guarded = [
        'id'
    ];

    public function payPaymentMethod()
    {
        return $this->hasMany(PayPaymentMethod::class);
    }
}
