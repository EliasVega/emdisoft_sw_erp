<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InvoiceTestSet extends Model
{
    use HasFactory;

    public $table = 'invoice_test_sets';

    protected $primaryKey = 'id';

    public $timestamps = true;

    protected $fillable = [
        'document_type',
        'message',
        'zipKey',
        'cufe',
        'company_id'
    ];

    protected $guarded = [
        'id'
    ];
}
