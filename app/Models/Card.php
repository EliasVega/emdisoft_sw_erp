<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Card extends Model
{
    use HasFactory;

    public $table = 'cards';

    protected $primaryKey = 'id';

    public $timestamps = false;

    protected $fillable = [
        'name'
    ];

    protected $guarded = [
        'id'
    ];

    public function payPaymenMethod(){
        return $this->BelongsToMany(PayPaymentMethod::class);
    }
}
