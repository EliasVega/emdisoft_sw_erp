<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    use HasFactory;

    public $table = 'accounts';

    protected $primaryKey = 'id';

    public $timestamps = true;

    protected $fillable = [
        'code',
        'name',
        'total_amount',
        'account_group_id'
    ];

    protected $guarded = [
        'id'
    ];

    public function accountGroup()
    {
        return $this->belongsTo(AccountGroup::class);
    }

    public function subaccounts()
    {
        return $this->hasMany(Subaccount::class);
    }
}
