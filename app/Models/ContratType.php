<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContratType extends Model
{
    use HasFactory;

    public $table = 'contrat_types';

    protected $primaryKey = 'id';

    public $timestamps = true;

    protected $fillable = [
        'code',
        'name',
    ];

    protected $guarded = [
        'id'
    ];

    public function employees()
    {
        return $this->hasMany(Employee::class);
    }
}
