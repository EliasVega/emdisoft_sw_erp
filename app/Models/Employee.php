<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    public $table = 'employees';

    protected $primaryKey = 'id';

    public $timestamps = true;

    protected $fillable = [

        'name',
        'identification',
        'dv',
        'address',
        'phone',
        'email',
        'code',
        'salary',
        'admission_date',
        'account_type',
        'account_number',
        'status',

        'department_id',
        'municipality_id',
        'identification_type_id',
        'employee_type_id',
        'employee_subtype_id',
        'payment_frecuency_id',
        'contrat_type_id',
        'charge_id',
        'payment_method_id',
        'bank_id',
    ];

    protected $guarded = [
        'id'
    ];

    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }

    public function municipality()
    {
        return $this->belongsTo(Municipality::class);
    }

    public function identificationType()
    {
        return $this->belongsTo(IdentificationType::class);
    }

    public function employeeType()
    {
        return $this->belongsTo(EmployeeType::class);
    }

    public function employeeSubtype()
    {
        return $this->belongsTo(EmployeeSubtype::class);
    }

    public function paymentFrecuency()
    {
        return $this->belongsTo(PaymentFrecuency::class);
    }

    public function contratType()
    {
        return $this->belongsTo(ContratType::class);
    }

    public function charge()
    {
        return $this->belongsTo(charge::class);
    }

    public function paymentMethod()
    {
        return $this->belongsTo(PaymentMethod::class);
    }

    public function bank()
    {
        return $this->belongsTo(Bank::class);
    }

    public function advances()
    {
        return $this->morphMany(Advance::class, 'advanceable');
    }

    public function overtimes()
    {
        return $this->belongsToMany(Overtime::class);
    }
}
