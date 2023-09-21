<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VoucherType extends Model
{
    use HasFactory;

    public $table = 'voucher_types';

    protected $primaryKey = 'id';

    public $timestamps = true;

    protected $fillable = [
        'code',
        'name',
        'consecutive',
        'status'
    ];

    protected $guarded = [
        'id'
    ];

    public function kardex()
    {
        return $this->hasOne(Kardex::class);
    }
}
