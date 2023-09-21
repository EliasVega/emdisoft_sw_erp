<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Advance extends Model
{
    use HasFactory;

    public $table = 'advances';

    protected $primaryKey = 'id';

    public $timestamps = true;

    protected $dates = [
        'created_at',
        'updated_at'
    ];

    protected $fillable = [
        'document',
        'origin',
        'destination',
        'pay',
        'balance',
        'note',
        'status',
        'type_third',
        'user_id',
        'branch_id',
        'voucher_type_id'
    ];

    protected $guarded = ['id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    //relacion polimorfica con terceros
    public function advanceable()
    {
        return $this->morphTo();
    }

    //relacion polimorfica con pagos
    public function pays()
    {
        return $this->morphMany(pay::class, 'payable');
    }

    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }
}
