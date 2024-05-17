<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Trigger extends Model
{
    use HasFactory;

    public $table = 'triggers';

    protected $primaryKey = 'id';

    public $timestamps = true;

    protected $dates = [
        'created_at',
        'updated_at'
    ];

    protected $fillable = [
        'puc_id'
    ];

    protected $guarded = [
        'id'
    ];

    public function triggerable()
    {
        return $this->morphTo();
    }

    public function puc()
    {
        return $this->belongsTo(Puc::class);
    }
}
