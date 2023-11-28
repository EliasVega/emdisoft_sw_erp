<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    public $table = 'customers';

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
        'credit_limit',
        'used',
        'available',
        'department_id',
        'municipality_id',
        'identification_type_id',
        'liability_id',
        'organization_id',
        'regime_id'
    ];

    protected $guarded = [
        'id'
    ];

    public function department()
    {
        return $this->belongsTo(Department::class);
    }

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

    public function advances()
    {
        return $this->morphMany(Advance::class, 'advanceable');
    }

    public function ndInvoices()
    {
        return $this->hasMany(Ndinvoice::class,);
    }

    public function ncInvoices()
    {
        return $this->hasMany(Ncinvoice::class,);
    }
}
