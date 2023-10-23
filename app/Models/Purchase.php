<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Purchase extends Model
{
    use HasFactory;

    public $table = 'purchases';

    protected $primaryKey = 'id';

    public $timestamps = true;

    protected $fillable = [
        'document',
        'invoice_code',
        'generation_date',
        'due_date',
        'retention',
        'total',
        'total_tax',
        'total_pay',
        'pay',
        'balance',
        'grand_total',
        'start_date',
        'status',
        'type_product',
        'user_id',
        'branch_id',
        'supplier_id',
        'payment_form_id',
        'payment_method_id',
        'resolution_id',
        'generation_type_id',
        'voucher_type_id',
        'document_type_id'
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

    public function ncpurchase(){
        return $this->hasOne(Ncpurchase::class);
    }

    public function ndpurchase(){
        return $this->hasOne(Ndpurchase::class);
    }
    //Relacion polimorfica con el pago
    public function pays()
    {
        return $this->morphMany(pay::class, 'payable');
    }

    public function taxes(): MorphMany
    {
        return $this->morphMany(Tax::class, 'taxable');
    }

    public function supportDocumentResponse()
    {
        return $this->hasOne(SupportDocumentResponse::class);
    }

    public function nsdResponse()
    {
        return $this->hasOne(NsdResponse::class);
    }
}
