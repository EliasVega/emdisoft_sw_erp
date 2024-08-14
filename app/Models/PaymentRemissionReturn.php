<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentRemissionReturn extends Model
{
    use HasFactory;

    public $table = 'payment_remission_returns';

    protected $primaryKey = 'id';

    public $timestamps = true;

    protected $fillable = [
        'payment',
        'return',
        'remission_id'
    ];

    protected $guarded = [
        'id'
    ];

    public function remission() {
        return $this->belongsTo(Remission::class);
    }
}
