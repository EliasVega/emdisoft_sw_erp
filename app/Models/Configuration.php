<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Configuration extends Model
{
    use HasFactory;

    public $table = 'configurations';

    protected $primaryKey = 'id';

    public $timestamps = true;

    protected $fillable = [
        'company_id',

        'ip',
        'creator_name',
        'company_name',
        'software_name',
    ];

    protected $guarded = [
        'id'
    ];

    public function company()
    {
        return $this->belongsTo(Company::class);
    }
}
