<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PurchaseOrder extends Model
{
    use HasFactory;

    public $table = 'purchase_orders';

    protected $primaryKey = 'id';

    public $timestamps = true;

    protected $fillable = [
        'total',
        'total_tax',
        'total_pay',
        'balance',
        'status',
        'user_id',
        'supplier_id',
    ];

    protected $guarded = [
        'id'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function resolution(){
        return $this->belongsTo(Resolution::class);
    }

    public function documentType(){
        return $this->belongsTo(DocumentType::class);
    }

    public function third(){
        return $this->belongsTo(Provider::class, 'provider_id');
    }

    public function branch(){
        return $this->belongsTo(Branch::class);
    }

    public function productPurchases(){
        return $this->hasMany(ProductPurchase::class);
    }

    public function voucherTipe()
    {
        return $this->belongsTo(VoucherType::class);
    }

    public function generationType(){
        return $this->hasOne(GenerationType::class);
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
