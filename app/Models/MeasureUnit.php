<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MeasureUnit extends Model
{
    use HasFactory;

    public $table = 'measure_units';

    protected $primaryKey = 'id';

    public $timestamps = false;

    protected $fillable = [
        'name',
        'code',
        'status'
    ];

    protected $guarded = [
        'id'
    ];

    public function products(){
        return $this->HasMany(Product::class);
    }
}
