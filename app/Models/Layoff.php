<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Layoff extends Model
{
    use HasFactory;

    public $table = 'layoffs';

    protected $primaryKey = 'id';

    public $timestamps = true;

    protected $fillable = [
        'start_period',
        'end_period',
        'layoff_days',
        'layoff_value',
        'layoff_interest',

        'payroll_acrued_id',
        'payroll_partial_acrued_id'
    ];

    public function payrollAcrued()
    {
        return $this->belongsTo(PayrollAcrued::class);
    }

    public function payrollPartialAcrued()
    {
        return $this->belongsTo(PayrollPartialAcrued::class);
    }
}
