<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InvoiceProduct extends Model
{
    use HasFactory;

    public $table = 'invoice_products';

    protected $primaryKey = 'id';

    public $timestamps = true;

    protected $fillable = [
        'quantity',
        'price',
        'tax_rate',
        'subtotal',
        'iva_subtotal',

        'invoice_id',
        'product_id'
    ];
    public function invoice(){
        return $this->belongsTo(Invoice::class);
    }

    public function product(){
        return $this->belongsTo(Product::class);
    }
}
