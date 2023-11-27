<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OvertimeMonth extends Model
{
    use HasFactory;

    public $table = 'overtime_months';

    protected $primaryKey = 'id';

    public $timestamps = true;

    protected $fillable = [
        'year_month',
        'percentage',
        'quantity',
        'value_hour',
        'subtotal',

        'overtime_type_id',
        'overtime_id'
    ];

    protected $guarded = [
        'id'
    ];

    public function overtime()
    {
        return $this->belongsTo(Overtime::class);
    }

    public function overtimeType()
    {
        return $this->belongsTo(OvertimeType::class);
    }
}
