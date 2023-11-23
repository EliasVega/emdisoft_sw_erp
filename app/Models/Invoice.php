<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Invoice extends Model
{

    use HasFactory;

    public $table = 'invoices';

    protected $primaryKey = 'id';

    public $timestamps = true;

    protected $fillable = [
        'document',
        'generation_date',
        'due_date',
        'total',
        'total_tax',
        'total_pay',
        'pay',
        'balance',
        'retention',
        'grand_total',
        'status',
        'note',

        'user_id',
        'branch_id',
        'customer_id',
        'payment_form_id',
        'payment_method_id',
        'resolution_id',
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
        return $this->belongsTo(Customer::class, 'customer_id');
    }

    public function branch(){
        return $this->belongsTo(Branch::class);
    }

    public function invoiceProducts(){
        return $this->hasMany(InvoiceProduct::class);
    }

    public function voucherTipe()
    {
        return $this->belongsTo(VoucherType::class);
    }

    public function paymentForm(){
        return $this->belongsTo(PaymentForm::class);
    }

    public function paymentMethod(){
        return $this->belongsTo(PaymentMethod::class);
    }

    public function ncpurchase(){
        return $this->hasOne(Ncinvoice::class);
    }

    public function ndpurchase(){
        return $this->hasOne(Ndinvoice::class);
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

    public function invoiceResponse()
    {
        return $this->hasOne(InvoiceResponse::class);
    }

    public function ncResponse()
    {
        return $this->hasOne(NcResponse::class);
    }
    public function ndResponse()
    {
        return $this->hasOne(NdResponse::class);
    }
    public function restaurantOrder()
    {
        return $this->hasOne(RestaurantOrder::class);
    }
}
