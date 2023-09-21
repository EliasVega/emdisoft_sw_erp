<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IdentificationType extends Model
{
    use HasFactory;

    public $table = 'identification_types';

    protected $primaryKey = 'id';

    public $timestamps = false;

    protected $fillable = [
        'code',
        'name',
        'initial'
    ];

    protected $guarded = [
        'id'
    ];

    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function providers()
    {
        return $this->hasMany(Provider::class);
    }

    public function customers()
    {
        return $this->hasMany(Customer::class);
    }

    public function employees()
    {
        return $this->hasMany(Employee::class);
    }
}
