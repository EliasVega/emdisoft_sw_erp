<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Municipality extends Model
{
    use HasFactory;

    public $table = 'municipalities';

    protected $primaryKey = 'id';

    public $timestamps = false;

    protected $fillable = [

        'code',
        'name',
        'department_id'
    ];

    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    public function branches()
    {
        return $this->hasMany(Branch::class);
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

    public function postalCodes()
    {
        return $this->hasMany(PostalCode::class);
    }
}
