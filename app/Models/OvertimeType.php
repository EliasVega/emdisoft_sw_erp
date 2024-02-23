<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OvertimeType extends Model
{
    use HasFactory;

    public $table = 'overtime_types';

    protected $primaryKey = 'id';

    public $timestamps = true;

    protected $fillable = [
        'code',
        'hour_type',
        'apply_time',
        'percentage'
    ];

    protected $guarded = [
        'id'
    ];

    public function overtimes()
    {
        return $this->hasMany(Overtime::class);
    }

    public function overtimeDays()
    {
        return $this->hasMany(OvertimeDay::class);
    }

    public function overtimeMonths()
    {
        return $this->hasMany(OvertimeMonth::class);
    }
}
