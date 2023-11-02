<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Overtime extends Model
{
    use HasFactory;

    public $table = 'overtimes';

    protected $primaryKey = 'id';

    public $timestamps = false;

    protected $fillable = [
        'date',
        'start_time',
        'end_time',
        'quantiry',
        'hour_value',
        'total',

        'employee_id',
        'overtime_type_id'
    ];

    protected $guarded = [
        'id'
    ];

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }

    public function overtimeType()
    {
        return $this->belongsTo(OvertimeType::class);
    }
}
