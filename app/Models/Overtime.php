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
        'year_month',
        'total',

        'employee_id'
    ];

    protected $guarded = [
        'id'
    ];

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
}
