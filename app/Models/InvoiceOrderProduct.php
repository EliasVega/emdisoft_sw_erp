<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InvoiceOrderProduct extends Model
{
    use HasFactory;

    public $table = 'invoice_order_products';

    protected $primaryKey = 'id';

    public $timestamps = true;

    protected $fillable = [
        'quantity',
        'price',
        'tax_rate',
        'subtotal',
        'tax_subtotal',

        'invoice_order_id',
        'product_id'
    ];
    public function invoiceOrder(){
        return $this->belongsTo(InvoiceOrder::class);
    }

    public function product(){
        return $this->belongsTo(Product::class);
    }

    public function employeeInvoiceOrderProduct(){
        return $this->hasOne(EmployeeInvoiceOrderProduct::class);
    }
}
