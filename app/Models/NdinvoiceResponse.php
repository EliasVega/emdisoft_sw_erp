<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NdinvoiceResponse extends Model
{
    use HasFactory;

    public $table = 'ndinvoice_responses';

    protected $primaryKey = 'id';

    public $timestamps = true;

    protected $fillable = [
        'document',
        'cude',
        'message',
        'valid',
        'code',
        'description',
        'status_message',
        'ndinvoice_id'
    ];

    protected $guarded = [
        'id'
    ];

    public function ndinvoice()
    {
        return $this->belongsTo(Ndinvoice::class);
    }
}
