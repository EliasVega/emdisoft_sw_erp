<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Provision extends Model
{
    use HasFactory;

    public $table = 'provisions';

    protected $primaryKey = 'id';

    public $timestamps = true;

    protected $fillable = [
        'start_period_vacations',
        'vacation_days',
        'vacations',
        'start_period_bonus',
        'bonus_days',
        'bonus',
        'start_period_layoffs',
        'layoff_days',
        'layoffs',
        'layoff_interest',

        'employee_id'
    ];

    protected $guarded = [
        'id'
    ];

    public function employee(){
        return $this->belongsTo(Employee::class);
    }

    public function provisionPartials(){
        return $this->hasMany(ProvisionPartial::class);
    }
}
