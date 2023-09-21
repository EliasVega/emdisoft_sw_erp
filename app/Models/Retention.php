<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Retention extends Model
{
    use HasFactory;

    public $table = 'retentions';

    protected $primaryKey = 'id';

    public $timestamps = true;

    protected $fillable = [
        'retention',
        'type',
        'company_tax_id'
    ];

    protected $guarded = [
        'id'
    ];

    public function retentionable()
    {
        return $this->morphTo();
    }

    public function companyTax()
    {
        return $this->belongsTo(Percentage::class);
    }
}
