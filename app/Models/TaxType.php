<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TaxType extends Model
{
    use HasFactory;

    public $table = 'tax_types';

    protected $primaryKey = 'id';

    public $timestamps = false;

    protected $fillable = [
        'code',
        'name',
        'description',
        'type_tax'
    ];

    protected $guarded = [
        'id'
    ];

    public function taxes()
    {
        return $this->hasMany(Tax::class);
    }
}
