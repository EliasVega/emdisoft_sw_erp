<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PayrollPartial extends Model
{
    use HasFactory;

    public $table = 'payroll_partials';

    protected $primaryKey = 'id';

    public $timestamps = true;

    protected $fillable = [
        'year_month',
        'start_date',
        'end_date',
        'payment_date',
        'generation_date',
        'days',
        'fortnight',

        'employee_id',
        'payroll_id'
    ];

    protected $guarded = [
        'id'
    ];

    public function employee() {
        return $this->belongsTo(Employee::class);
    }
}
