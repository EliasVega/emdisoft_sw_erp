<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeeInvoiceOrderProduct extends Model
{
    use HasFactory;

    public $table = 'employee_invoice_order_products';

    protected $primaryKey = 'id';

    public $timestamps = true;

    protected $fillable = [
        'generation_date',
        'quantity',
        'price',
        'subtotal',
        'commission',
        'value_commission',
        'status',
        'work_labor_id',
        'invoice_order_product_id',
        'employee_id',
    ];
    public function invoiceOrderProduct(){
        return $this->belongsTo(InvoiceOrderProduct::class);
    }

    public function employee(){
        return $this->belongsTo(Employee::class);
    }
}
