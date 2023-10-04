<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NsdResponse extends Model
{
    use HasFactory;

    public $table = 'nsd_responses';

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
        'ndpurchase_id'
    ];

    protected $guarded = [
        'id'
    ];

    public function ndpurchase()
    {
        return $this->belongsTo(Ndpurchase::class);
    }
}
