<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Certificate extends Model
{
    use HasFactory;

    public $table = 'certificates';

    protected $primaryKey = 'id';

    public $timestamps = true;

    protected $fillable = [
        'company_id',

        'file',
        'password',
        'expiration_date'
    ];

    protected $guarded = [
        'id'
    ];

    public function company()
    {
        return $this->belongsTo(Company::class);
    }
}
