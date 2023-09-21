<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{
    use HasFactory;

    public $table = 'branches';

    protected $primaryKey = 'id';

    public $timestamps = true;

    protected $fillable = [
        'name',
        'address',
        'phone',
        'mobile',
        'email',
        'manager',
        'department_id',
        'municipality_id',
        'company_id',
    ];

    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    public function municipality()
    {
        return $this->belongsTo(Municipality::class);
    }

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function kardexes()
    {
        return $this->hasMany(Kardex::class);
    }

    public function transfers()
    {
        return $this->hasMany(Kardex::class);
    }

    public function branchproducts(){
        return $this->hasMany(BranchProduct::class);
    }

    public function pays()
    {
        return $this->hasMany(pay::class);
    }

    public function advances()
    {
        return $this->hasMany(Advance::class);
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function prePurchases()
    {
        return $this->hasMany(PrePurchase::class);
    }

    public function ncPurchases()
    {
        return $this->hasMany(Ncpurchase::class);
    }

    public function expenses()
    {
        return $this->hasMany(Expense::class);
    }
}
