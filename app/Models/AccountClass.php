<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccountClass extends Model
{
    use HasFactory;

    public $table = 'account_classes';

    protected $primaryKey = 'id';

    public $timestamps = false;

    protected $fillable = [
        'code',
        'name',
        'total_amount'
    ];

    protected $guarded = [
        'id'
    ];

    public function accountGroups()
    {
        return $this->hasMany(AccountGroup::class);
    }
}
