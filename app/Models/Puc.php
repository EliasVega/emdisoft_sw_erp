<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Puc extends Model
{
    use HasFactory;
    public $table = 'pucs';

    protected $primaryKey = 'id';

    public $timestamps = true;

    protected $dates = [
        'created_at',
        'updated_at'
    ];

    protected $fillable = [
        'trigger',
        'movement',
        'type',
        'bank_account',
        'bank_id'
    ];

    protected $guarded = [
        'id'
    ];

    public function accountable()
    {
        return $this->morphTo();
    }

    public function bank()
    {
        return $this->belongsTo(Bank::class);
    }

    public function triggers()
    {
        return $this->hasMany(Trigger::class);
    }

    public function movements()
    {
        return $this->hasMany(Movement::class);
    }
}
