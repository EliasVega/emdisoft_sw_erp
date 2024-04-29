<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Causation extends Model
{
    use HasFactory;


    public $table = 'causations';

    protected $primaryKey = 'id';

    public $timestamps = true;

    protected $fillable = [
        'causation',
        'start_period',
        'end_period',
        'causation_value',
        'causation_interest',
        'status',

        'payroll_acrued_id',
        'payroll_partial_acrued_id'
    ];

    protected $guarded = [
        'id'
    ];
}
