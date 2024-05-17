<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AuxiliaryAccount extends Model
{
    use HasFactory;

    public $table = 'auxiliary_accounts';

    protected $primaryKey = 'id';

    public $timestamps = true;

    protected $fillable = [
        'code',
        'name',
        'total_amount',
        'status',
        'subaccount_id'
    ];

    protected $guarded = [
        'id'
    ];

    public function subaccount()
    {
        return $this->belongsTo(Subaccount::class);
    }
    public function subauxiliaryAccounts()
    {
        return $this->hasMany(SubauxiliaryAccount::class);
    }

    public function puc()
    {
        return $this->morphOne(Puc::class, 'accountable');
    }
}
