<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProvisionPartial extends Model
{
    use HasFactory;

    public $table = 'provision_partials';

    protected $primaryKey = 'id';

    public $timestamps = true;

    protected $fillable = [
        'start_period',
        'end_period',
        'vacations',
        'bonus',
        'layoffs',
        'layoff_interest',
        'vacation_adjustment',
        'status',

        'provision_id',
        'payroll_acrued_id',
        'payroll_partial_acrued_id',
    ];

    protected $guarded = [
        'id'
    ];

    public function provision(){
        return $this->belongsTo(Provision::class);
    }

    public function payrollAcrued(){
        return $this->belongsTo(PayrollAcrued::class);
    }

    public function payrollPartialAcrued()
    {
        return $this->belongsTo(PayrollPartialAcrued::class);
    }
}
