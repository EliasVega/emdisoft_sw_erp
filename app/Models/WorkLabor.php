<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WorkLabor extends Model
{
    use HasFactory;

    public $table = 'work_labors';

    protected $primaryKey = 'id';

    public $timestamps = true;

    protected $fillable = [
        'generation_date',
        'total',
        'note',

        'user_id',
        'employee_id',
        'voucher_type_id',
    ];

    protected $guarded = [
        'id'
    ];

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function voucherType()
    {
        return $this->belongsTo(VoucherType::class);
    }

    public function pays()
    {
        return $this->morphMany(pay::class, 'payable');
    }

    public function third(){
        return $this->belongsTo(Employee::class, 'employee_id');
    }
}
