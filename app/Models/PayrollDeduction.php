<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PayrollDeduction extends Model
{
    use HasFactory;

    public $table = 'payroll_acrueds';

    protected $primaryKey = 'id';

    public $timestamps = true;

    protected $fillable = [
        'eps',
        'pension',
        'fsp',
        'subsistence_fund',
        'unions',
        'sanctions',
        'advances',
        'payment_thirds',
        'other_deductions',
        'releases',
        'optionales',

        'payroll_id'
    ];

    protected $guarded = [
        'id'
    ];
}
