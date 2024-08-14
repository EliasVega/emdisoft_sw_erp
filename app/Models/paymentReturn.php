<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PgareaymentReturn extends Model
{
    use HasFactory;

    public $table = 'payment_returns';

    protected $primaryKey = 'id';

    public $timestamps = true;

    protected $fillable = [
        'payment',
        'return',
        'invoice_id'
    ];

    protected $guarded = [
        'id'
    ];

    public function invoice() {
        return $this->belongsTo(Invoice::class);
    }
}
