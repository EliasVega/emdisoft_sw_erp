<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Accounting extends Model
{
    use HasFactory;

    public $table = 'accountings';

    protected $primaryKey = 'id';

    public $timestamps = true;

    protected $dates = [
        'created_at',
        'updated_at'
    ];

    protected $fillable = [
        'type',
        'consecutive',
        'generation_date',
        'voucher_type_id'
    ];

    protected $guarded = [
        'id'
    ];

    public function voucherType()
    {
        return $this->belongsTo(VoucherType::class);
    }

    public function movements()
    {
        return $this->hasMany(Movement::class);
    }
}
