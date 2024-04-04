<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Overtime extends Model
{
    use HasFactory;

    public $table = 'overtimes';

    protected $primaryKey = 'id';

    public $timestamps = true;

    protected $fillable = [
        'year_month',
        'total',

        'employee_id',
        'payroll_acrued_id'
    ];

    protected $guarded = [
        'id'
    ];

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }

    public function overtimeMonths()
    {
        return $this->hasMany(OvertimeMonth::class);
    }

    public function payrollAcrued()
    {
        return $this->belongsTo(PayrollAcrued::class);
    }


}
