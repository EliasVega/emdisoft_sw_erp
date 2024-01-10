<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

        public $table = 'payments';

        protected $primaryKey = 'id';

        public $timestamps = true;

        protected $fillable = [
            'pay',
            'note',
            'type_third',
            'user_id'
        ];

        protected $guarded = [
            'id'
        ];

        //Relacion polimorfica con tipo terceros
        public function paymentable()
        {
            return $this->morphTo();
        }

        public function user(){
            return $this->belongsTo(User::class);
        }

        public function pays(){
            return $this->hasMany(Pay::class);
        }

        public function paymentPaymentMethods()
    {
        return $this->hasMany(PaymentPaymentMethod::class);
    }
}
