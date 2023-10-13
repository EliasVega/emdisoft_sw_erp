<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NcinvoiceResponse extends Model
{
    use HasFactory;

    public $table = 'ncinvoice_responses';

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
        'ncinvoice_id'
    ];

    protected $guarded = [
        'id'
    ];

    public function ncinvoice()
    {
        return $this->belongsTo(Ncinvoice::class);
    }
}
