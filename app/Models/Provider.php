<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Provider extends Model
{
    use HasFactory;

    public $table = 'providers';

    protected $primaryKey = 'id';

    public $timestamps = true;

    protected $fillable = [
        'name',
        'identification',
        'dv',
        'address',
        'phone',
        'email',
        'merchant_registration',
        'contact',
        'phone_contact',
        'department_id',
        'municipality_id',
        'postal_code_id',
        'identification_type_id',
        'liability_id',
        'organization_id',
        'regime_id'
    ];

    protected $guarded = [
        'id'
    ];

    public function municipality()
    {
        return $this->belongsTo(Municipality::class);
    }

    public function identificationType()
    {
        return $this->belongsTo(IdentificationType::class);
    }

    public function liability()
    {
        return $this->belongsTo(Liability::class);
    }

    public function organization()
    {
        return $this->belongsTo(Organization::class);
    }

    public function regime()
    {
        return $this->belongsTo(Regime::class);
    }
    public function purchaseOrder()
    {
        return $this->hasMany(PurchaseOrder::class);
    }

    public function purchase()
    {
        return $this->hasMany(Purchase::class);
    }

    public function advances()
    {
        return $this->morphMany(Advance::class, 'advanceable');
    }

    public function postalCode()
    {
        return $this->belongsTo(PostalCode::class);
    }

    public function ndPurchases()
    {
        return $this->hasMany(Ndpurchase::class,);
    }

    public function ncPurchases()
    {
        return $this->hasMany(Ncpurchase::class,);
    }
}
