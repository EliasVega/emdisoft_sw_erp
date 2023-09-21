<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CashOutflow extends Model
{
    use HasFactory;

    public $table = 'cash_outflows';

    protected $primaryKey = 'id';

    public $timestamps = true;

    protected $fillable = [
        'cash',
        'reason',
        'cash_register_id',
        'user_id',
        'branch_id',
        'admin_id'
    ];

    protected $guarded = [
        'id'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function admin(){
        return $this->belongsTo(User::class);
    }

    public function branch(){
        return $this->belongsTo(Branch::class);
    }

    public function cashRegister(){
        return $this->belongsTo(CashRegister::class);
    }
}
