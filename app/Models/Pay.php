<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pay extends Model
{
    use HasFactory;

    public $table = 'pays';

    protected $primaryKey = 'id';

    public $timestamps = true;

    protected $fillable = [
        'pay',
        'balance',
        'type',
        'user_id',
        'branch_id'
    ];

    protected $guarded = [
        'id'
    ];

    //Relacion polimorfica con tipo de documento
    public function payable()
    {
        return $this->morphTo();
    }

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

    public function payPaymentMethods()
    {
        return $this->hasMany(PayPaymentMethod::class);
    }
}
