<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccountGroup extends Model
{
    use HasFactory;

    public $table = 'account_groups';

    protected $primaryKey = 'id';

    public $timestamps = false;

    protected $fillable = [
        'code',
        'name',
        'total_amount',
        'account_class_id'
    ];

    protected $guarded = [
        'id'
    ];

    public function accountClass()
    {
        return $this->belongsTo(AccountClass::class);
    }

    public function accounts()
    {
        return $this->hasMany(Account::class);
    }
}
