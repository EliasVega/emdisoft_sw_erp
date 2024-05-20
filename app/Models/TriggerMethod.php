<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TriggerMethod extends Model
{
    use HasFactory;

    public $table = 'trigger_methods';

    protected $primaryKey = 'id';

    public $timestamps = true;

    protected $fillable = [
        'name',
        'description'
    ];

    public function pucs(){
        return $this->hasMany(Puc::class);
    }
}
