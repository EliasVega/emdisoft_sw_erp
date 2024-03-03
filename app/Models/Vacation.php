<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vacation extends Model
{
    use HasFactory;

    public $table = 'vacations';

    protected $primaryKey = 'id';

    public $timestamps = true;

    protected $fillable = [
        'start_vacations',
        'end_vacations',
        'vacation_days',
        'value_day',
        'value',
        'type',
        'payroll_acrued_id',
        'payroll_partial_acrued_id'
    ];

    protected $guarded = [
        'id'
    ];

    public function payrollAcrued(){
        return $this->belongsTo(PayrollAcrued::class);
    }

    public function payrollPartialAcrued()
    {
        return $this->belongsTo(PayrollPartialAcrued::class);
    }
}
