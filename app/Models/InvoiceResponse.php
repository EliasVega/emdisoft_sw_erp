<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InvoiceResponse extends Model
{
    use HasFactory;

    public $table = 'invoice_responses';

    protected $primaryKey = 'id';

    public $timestamps = true;

    protected $fillable = [
        'document',
        'cufe',
        'message',
        'valid',
        'code',
        'description',
        'status_message',
        'invoice_id'
    ];

    protected $guarded = [
        'id'
    ];

    public function invoice()
    {
        return $this->belongsTo(Invoice::class);
    }
}
