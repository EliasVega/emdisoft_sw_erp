<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payroll extends Model
{
    use HasFactory;

    public $table = 'payrolls';

    protected $primaryKey = 'id';

    public $timestamps = true;

    protected $fillable = [
        'start_date',
        'end_date',
        'payment_date',
        'generation_date',
        'days',

        'employee_id'
    ];

    protected $guarded = [
        'id'
    ];

    public function employee() {
        return $this->belongsTo(Employee::class);
    }
}
