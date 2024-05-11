<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Software extends Model
{
    use HasFactory;

    public $table = 'software';

    protected $primaryKey = 'id';

    public $timestamps = true;

    protected $fillable = [
        'company_id',
        'identifier',
        'pin',
        'test_set',
        'identifier_payroll',
        'pin_payroll',
        'payroll_test_set',
        'identifier_equidoc',
        'pin_equidoc',
        'equidoc_test_set'
    ];

    protected $guarded = [
        'id'
    ];

    public function company()
    {
        return $this->belongsTo(Company::class);
    }
}
