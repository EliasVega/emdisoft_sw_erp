<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class License extends Model
{
    use HasFactory;

    public $table = 'licenses';

    protected $primaryKey = 'id';

    public $timestamps = true;

    protected $fillable = [
        'start_license',
        'end_license',
        'days_license',
        'value_day',
        'total_license',
        'type_license',
        'type_pay',
        'note',
        'payroll_acrued_id',
        'payroll_partial_acrued_id'
    ];

    protected $guarded = [
        'id'
    ];
}
