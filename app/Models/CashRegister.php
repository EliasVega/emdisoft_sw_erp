<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CashRegister extends Model
{
    use HasFactory;

    public $table = 'cash_registers';

    protected $primaryKey = 'id';

    public $timestamps = true;

    protected $fillable = [
        'cash_initial',
        'in_cash',
        'out_cash',
        'in_total',
        'out_total',
        'cash_in_total',
        'cash_out_total',
        'invoice_order',
        'restaurant_order',
        'in_invoice_cash',
        'in_invoice',
        'invoice',
        'in_advance_cash',
        'in_advance',
        'ndinvoice',
        'ndpurchase',
        'ncinvoice',
        'ncpurchase',
        'purchase_order',
        'out_purchase_cash',
        'out_purchase',
        'purchase',
        'out_expense_cash',
        'out_expense',
        'expense',
        'out_advance_cash',
        'out_advance',
        'verification_code_open',
        'verification_code_close',
        'status',
        'branch_id',
        'user_id',
        'user_open',
        'user_close'

    ];

    protected $guarded = [
        'id'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function branch(){
        return $this->belongsTo(Branch::class);
    }

    public function cashInflows(){
        return $this->belongsTo(CashInflow::class);
    }

    public function cashOutflows(){
        return $this->hasMany(CashOutflow::class);
    }
}
