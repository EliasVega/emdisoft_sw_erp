<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PayrollAcrued extends Model
{
    use HasFactory;

    public $table = 'payroll_acrueds';

    protected $primaryKey = 'id';

    public $timestamps = true;

    protected $fillable = [
        'salary',
        'transport_assistance',
        'overtime',
        'vacations',
        'bonus',
        'layoffs',
        'disabilities',
        'licenses',
        'bonuses',
        'aids',
        'commissions',
        'payment_thirds',
        'advances',
        'compensations',
        'bonuses_EPCTV',
        'other_concepts',
        'legal_strikes',
        'optionales',

        'payroll_id'
    ];

    protected $guarded = [
        'id'
    ];

    public function vacations() {
        return $this->hasMany(Vacation::class);
    }

    public function overtimes() {
        return $this->hasMany(Overtime::class);
    }
}
