<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Novelty extends Model
{
    use HasFactory;

    public $table = 'novelties';

    protected $primaryKey = 'id';

    public $timestamps = true;

    protected $fillable = [
        'year_month',
        'type_novelty',
        'name_novelty',
        'value_novelty',
        'note',
        'compensation_type',

        'payroll_acrued_id',
        'payroll_partial_acrued_id'
    ];

    protected $guarded = [
        'id'
    ];
}
