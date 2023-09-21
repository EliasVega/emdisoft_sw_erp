<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class charge extends Model
{
    use HasFactory;

    public $table = 'charges';

    protected $primaryKey = 'id';

    public $timestamps = true;

    protected $fillable = [
        'name',
        'description',
        'status'
    ];

    protected $guarded = [
        'id'
    ];

    public function employees()
    {
        return $this->hasMany(Employee::class);
    }
}
