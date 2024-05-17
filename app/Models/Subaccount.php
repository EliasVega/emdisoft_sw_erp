<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subaccount extends Model
{
    use HasFactory;

    public $table = 'subaccounts';

    protected $primaryKey = 'id';

    public $timestamps = true;

    protected $fillable = [
        'code',
        'name',
        'total_amount',
        'status',
        'account_id'
    ];

    protected $guarded = [
        'id'
    ];

    public function account()
    {
        return $this->belongsTo(Account::class);
    }

    public function auxiliaryAccounts()
    {
        return $this->hasMany(AuxiliaryAccount::class);
    }

    public function puc()
    {
        return $this->morphOne(Puc::class, 'accountable');
    }
}
