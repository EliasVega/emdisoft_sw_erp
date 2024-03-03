<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bonus extends Model
{
    use HasFactory;

    public $table = 'bonuses';

    protected $primaryKey = 'id';

    public $timestamps = true;

    protected $fillable = [
        'start_period',
        'end_period',
        'bonus_days',
        'bonus_value',
        'type',

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
