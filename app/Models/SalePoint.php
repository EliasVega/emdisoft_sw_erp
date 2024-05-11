<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SalePoint extends Model
{
    use HasFactory;
    public $table = 'sale_points';

    protected $primaryKey = 'id';

    public $timestamps = true;

    protected $fillable = [
        'branch_id',

        'plate_number',
        'location',
        'cash_type'
    ];

    protected $guarded = [
        'id'
    ];

    public function branch() {
        return $this->belongsTo(Branch::class);
    }

    public function cashRegisters() {
        return $this->hasMany(CashRegister::class);
    }
}
