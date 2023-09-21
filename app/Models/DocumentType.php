<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DocumentType extends Model
{
    use HasFactory;

    public $table = 'document_types';

    protected $primaryKey = 'id';

    public $timestamps = true;

    protected $fillable = [
        'code',
        'name',
        'prefix',
        'cufe_algorithm'
    ];

    protected $guarded = [
        'id'
    ];

    public function resolutions()
    {
        return $this->hasMany(Resolution::class);
    }

    public function purchases(){
        return $this->hasMany(Purchase::class);
    }
}
