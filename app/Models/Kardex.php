<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kardex extends Model
{
    use HasFactory;

    use HasFactory;

    public $table = 'kardexes';

    protected $primaryKey = 'id';

    public $timestamps = true;

    protected $fillable = [
        'product_id',
        'branch_id',
        'voucher_type_id',
        'document',
        'quantity',
        'stock',
        'movement'
    ];

    public function product(){
        return $this->hasOne(Product::class);
    }

    public function branch(){
        return $this->belongsTo(Branch::class);
    }

    public function voucherType()
    {
        return $this->belongsTo(VoucherType::class);
    }
}
