<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Resolution extends Model
{
    use HasFactory;

    public $table = 'resolutions';

    protected $primaryKey = 'id';

    public $timestamps = true;

    protected $fillable = [
        'prefix',
        'resolution',
        'resolution_date',
        'technical_key',
        'start_number',
        'end_number',
        'consecutive',
        'start_date',
        'end_date',
        'status',
        'company_id',
        'document_type_id'
    ];

    protected $guarded = [
        'id'
    ];

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function purchases()
    {
        return $this->hasMany(Purchase::class);
    }

    public function documentType()
    {
        return $this->belongsTo(DocumentType::class);
    }

    public function ndpurchases()
    {
        return $this->hasMany(Ndpurchase::class);
    }
}
