<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Percentage extends Model
{
    use HasFactory;

    public $table = 'percentages';

    protected $primaryKey = 'id';

    public $timestamps = false;

    protected $fillable = [
        'name',
        'percentage',
        'base',
        'base_uvt',
        'concept',
        'status',
        'tax_type_id'
    ];

    protected $guarded = [
        'id'
    ];

    public function retentions()
    {
        return $this->hasMany(Retention::class);
    }

    public function taxes()
    {
        return $this->hasMany(Tax::class);
    }

    public function companyTaxes()
    {
        return $this->hasMany(CompanyTax::class);
    }
}
