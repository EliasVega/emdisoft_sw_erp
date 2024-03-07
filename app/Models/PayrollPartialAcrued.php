<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PayrollPartialAcrued extends Model
{
    use HasFactory;

    public $table = 'payroll_partial_acrueds';

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

        'payroll_partial_id'
    ];

    protected $guarded = [
        'id'
    ];

    public function employee() {
        return $this->belongsTo(Employee::class);
    }

    public function vacations() {
        return $this->hasMany(Vacation::class);
    }

    public function overtimes() {
        return $this->hasMany(Overtime::class);
    }

    public function bonuses() {
        return $this->hasMany(Bonus::class);
    }

    public function layoff() {
        return $this->hasOne(Layoff::class);
    }

    public function provisionPartial() {
        return $this->hasOne(Layoff::class);
    }
}
