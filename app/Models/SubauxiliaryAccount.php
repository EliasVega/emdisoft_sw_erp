<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubauxiliaryAccount extends Model
{
    use HasFactory;

    public $table = 'subauxiliary_accounts';

    protected $primaryKey = 'id';

    public $timestamps = true;

    protected $fillable = [
        'code',
        'name',
        'total_amount',
        'status',
        'subauxiliary_account_id'
    ];

    protected $guarded = [
        'id'
    ];

    public function auxiliaryAccount()
    {
        return $this->belongsTo(AuxiliaryAccount::class);
    }

    public function puc()
    {
        return $this->morphOne(Puc::class, 'accountable');
    }
}
