<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Ndpurchase extends Model
{
    use HasFactory;

    public $table = 'ndpurchases';

    protected $primaryKey = 'id';

    public $timestamps = true;

    protected $fillable = [
        'document',
        'retention',
        'total',
        'total_tax',
        'total_pay',
        'user_id',
        'branch_id',
        'purchase_id',
        'provider_id',
        'resolution_id',
        'nc_discrepancy_id',
        'voucher_type_id',
        'document_type_id',
        'cash_register_id'
    ];

    protected $guarded = [
        'id'
    ];

    public function branch(){
        return $this->belongsTo(Branch::class);
    }

    public function purchase(){
        return $this->belongsTo(Purchase::class);
    }

    public function third(){
        return $this->belongsTo(Provider::class, 'provider_id');
    }

    public function products(){
        return $this->belongsToMany(Product::class);
    }

    public function discrepancy(){
        return $this->belongsTo(Discrepancy::class);
    }
    public function user(){
        return $this->belongsTo(User::class);
    }

    public function resolution(){
        return $this->belongsTo(Resolution::class);
    }

    public function taxes(): MorphMany
    {
        return $this->morphMany(Tax::class, 'taxable');
    }

    public function cashRegister() {
        return $this->belongsTo(CashRegister::class);
    }

    public function nsdResponse() {
        return $this->hasOne(NsdResponse::class);
    }
}
