<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeeInvoiceProduct extends Model
{
    use HasFactory;

    use HasFactory;

    public $table = 'employee_invoice_products';

    protected $primaryKey = 'id';

    public $timestamps = true;

    protected $fillable = [
        'quantity',
        'price',
        'subtotal',
        'commission',
        'value>_commission',
        'status',
        'work_labor_id',
        'invoice_product_id',
        'employee_id',
    ];
    public function invoiceProduct(){
        return $this->belongsTo(InvoiceProduct::class);
    }

    public function employee(){
        return $this->belongsTo(Employee::class);
    }
}
