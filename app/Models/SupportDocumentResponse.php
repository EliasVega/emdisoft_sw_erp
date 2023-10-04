<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SupportDocumentResponse extends Model
{
    use HasFactory;

    public $table = 'support_document_responses';

    protected $primaryKey = 'id';

    public $timestamps = true;

    protected $fillable = [
        'document',
        'cuds',
        'message',
        'valid',
        'code',
        'description',
        'status_message',
        'purchase_id'
    ];

    protected $guarded = [
        'id'
    ];

    public function purchase()
    {
        return $this->belongsTo(Purchase::class);
    }

}
