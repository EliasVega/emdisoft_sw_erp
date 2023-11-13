<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    use HasFactory;

    public $table = 'departments';

    protected $primaryKey = 'id';

    public $timestamps = false;

    protected $fillable = [
        //
        'name',
        'dane_code',
        'iso_code'
    ];

    public function municipalities()
    {
        return $this->hasMany(Municipality::class);
    }

    public function branches()
    {
        return $this->hasMany(Branch::class);
    }

    public function customers()
    {
        return $this->hasMany(Customer::class);
    }
}
