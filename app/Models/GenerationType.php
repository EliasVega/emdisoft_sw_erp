<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GenerationType extends Model
{
    use HasFactory;

    public $table = 'generation_types';

    protected $primaryKey = 'id';

    public $timestamps = false;

    protected $fillable = [
        'description'
    ];

    protected $guarded = [
        'id'
    ];

    public function purchases(){
        return $this->HasMany(Purchase::class);
    }
}
