<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movement extends Model
{
    use HasFactory;

    public $table = 'movements';

    protected $primaryKey = 'id';

    public $timestamps = true;

    protected $fillable = [
        'amount',
        'type',
        'base',
        'percentage',
        'description',
        'accounting_id',
        'cost_center_id',
        'puc_id'
    ];

    protected $guarded = [
        'id'
    ];

    public function movementable()
    {
        return $this->morphTo();
    }

    public function accounting()
    {
        return $this->belongsTo(Accounting::class);
    }

    public function costCenter()
    {
        return $this->belongsTo(CostCenter::class);
    }

    public function puc()
    {
        return $this->belongsTo(Puc::class);
    }
}
