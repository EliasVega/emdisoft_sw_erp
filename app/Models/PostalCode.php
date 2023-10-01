<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostalCode extends Model
{
    use HasFactory;

    public $table = 'postal_codes';

    protected $primaryKey = 'id';

    public $timestamps = true;

    protected $fillable = [
        'postal_code',
        'municipality_id'
    ];

    protected $guarded = [
        'id'
    ];

    public function municipality()
    {
       return $this->belongsTo(Municipality::class);
    }

    public function providers()
    {
       return $this->hasMany(Provider::class);
    }
}
