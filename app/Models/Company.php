<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;

    public $table = 'companies';

    protected $primaryKey = 'id';

    public $timestamps = true;

    protected $fillable = [
        //
        'name',
        'nit',
        'dv',
        'address',
        'phone',
        'api_token',
        'email',
        'emailfe',
        'imageName',
        'logo',
        'pos_invoice',
        'pos_purchase',
        'status',
        'department_id',
        'municipaliy_id',
        'identification_type_id',
        'liability_id',
        'organization_id',
        'regime_id'
    ];

    public function identificationType()
    {
        return $this->belongsTo(IdentificationType::class);
    }

    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    public function municipality()
    {
        return $this->belongsTo(Municipality::class);
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

    public function branches()
    {
        return $this->hasMany(Branch::class);
    }

    public function resolutions()
    {
        return $this->hasMany(Resolution::class);
    }

    public function indicator(){
        return $this->hasOne(Indicator::class);
    }

    public function software()
    {
        return $this->hasOne(Software::class);
    }

    public function certificate()
    {
        return $this->hasOne(Certificate::class);
    }
    public function configuration()
    {
        return $this->hasOne(Configuration::class);
    }
}
