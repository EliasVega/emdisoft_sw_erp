<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OvertimeDay extends Model
{
    use HasFactory;

    public $table = 'overtime_days';

    protected $primaryKey = 'id';

    public $timestamps = true;

    protected $fillable = [
        'year_month',
        'start_time',
        'end_time',
        'quantity',
        'value_hour',
        'subtotal',
        'status',

        'overtime_Type_id',
        'overtime_month_id'
    ];

    protected $guarded = [
        'id'
    ];

    public function overtimeMonth()
    {
        return $this->belongsTo(OvertimeMonth::class);
    }

    public function overtimeType()
    {
        return $this->belongsTo(OvertimeType::class);
    }
}
