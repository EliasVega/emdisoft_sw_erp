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
        'weekly_hours',
        'uvt',
        'plastic_bag_tax',
        'dian',
        'pos',
        'logo',
        'payroll',
        'work_labor',
        'accounting',
        'inventory',
        'product_price',
        'raw_material',
        'restaurant',
        'barcode',
        'cvpinvoice',
        'sqio',
        'cmep',
        'imgp',
        'price_with_tax'
    ];

    protected $guarded = [
        'id'
    ];

    public function company(){
        return $this->belongsTo(Company::class);
    }
}
