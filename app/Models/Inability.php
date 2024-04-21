<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inability extends Model
{

    use HasFactory;

    public $table = 'inabilities';

    protected $primaryKey = 'id';

    public $timestamps = true;

    protected $fillable = [
        'start_inability',
        'end_inability',
        'days_inability',
        'value_day',
        'total_inability',
        'origin',
        'payroll_acrued_id',
        'payroll_partial_acrued_id'
    ];

    protected $guarded = [
        'id'
    ];
}
