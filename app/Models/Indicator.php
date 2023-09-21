<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Indicator extends Model
{
    use HasFactory;

    public $table = 'indicators';

    protected $primaryKey = 'id';

    public $timestamps = true;

    protected $fillable = [
        'smlv',
        'transport_assistance',
        'plastic_bag_tax',
        'dian',
        'post',
        'payroll',
        'accounting',
        'inventory',
        'product_price'
    ];

    protected $guarded = [
        'id'
    ];

    public function company(){
        return $this->belongsTo(Company::class);
    }
}
