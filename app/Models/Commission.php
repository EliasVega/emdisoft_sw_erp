<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Commission extends Model
{

    use HasFactory;

    public $table = 'commissions';

    protected $primaryKey = 'id';

    public $timestamps = true;

    protected $fillable = [
        'start_commission',
        'end_commission',
        'type_commission',
        'value_commission',
        'note',

        'payroll_acrued_id',
        'payroll_partial_acrued_id'
    ];

    protected $guarded = [
        'id'
    ];
}
