<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Tax extends Model
{
    use HasFactory;

    public $table = 'taxes';

    protected $primaryKey = 'id';

    public $timestamps = true;

    protected $fillable = [
        'taxable',
        'tax_value',
        'type',
        'company_tax_id'
    ];

    protected $guarded = [
        'id'
    ];

    public function taxable(): MorphTo
    {
        return $this->morphTo();
    }

    public function companyTax()
    {
        return $this->belongsTo(CompanyTax::class);
    }
}
