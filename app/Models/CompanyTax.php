<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompanyTax extends Model
{
    use HasFactory;

    public $table = 'company_taxes';

    protected $primaryKey = 'id';

    public $timestamps = true;

    protected $fillable = [
        'name',
        'description',

        'tax_type_id',
        'percentage_id',
    ];

    protected $guarded = [
        'id'
    ];

    public function taxType()
    {
        return $this->belongsTo(TaxType::class);
    }

    public function percentage()
    {
        return $this->belongsTo(Percentage::class);
    }

    public function categories()
    {
        return $this->hasMany(Category::class);
    }

    public function retentions()
    {
        return $this->hasMany(Retention::class);
    }
}
