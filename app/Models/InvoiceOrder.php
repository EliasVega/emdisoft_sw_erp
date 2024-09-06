<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InvoiceOrder extends Model
{
    use HasFactory;

    public $table = 'invoice_orders';

    protected $primaryKey = 'id';

    public $timestamps = true;

    protected $fillable = [
        'generation_date',
        'due_date',
        'total',
        'total_tax',
        'total_pay',
        'balance',
        'status',
        'type',
        'user_id',
        'customer_id',
        'branch_id',
        'invoice_id',
        'cash_register_id'
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
        return $this->belongsTo(Customer::class, 'customer_id');
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

    public function cashRegister() {
        return $this->belongsTo(CashRegister::class);
    }
}
