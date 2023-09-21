<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{

    use HasFactory;

    public $table = 'categories';

    protected $primaryKey = 'id';

    public $timestamps = true;

    protected $fillable = [
        'name',
        'description',
        'utility_rate',
        'status',
        'company_tax_id'
    ];

    public function products()
    {
        return $this->hasMany(Category::class);
    }

    public function companyTax()
    {
        return $this->belongsTo(CompanyTax::class);
    }
}
