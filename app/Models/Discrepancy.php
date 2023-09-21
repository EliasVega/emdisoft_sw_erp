<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Discrepancy extends Model
{
    use HasFactory;

    public $table = 'discrepancies';

    protected $primaryKey = 'id';

    public $timestamps = false;

    protected $fillable = [
        'code',
        'type',
        'description',
        'status'
    ];


    public function ndpurchase()
    {
        return $this->hasMany(Ndpurchase::class);
    }
}
