<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BranchProduct extends Model
{
    use HasFactory;

    public $table = 'branch_products';

    public $timestamps = true;

    protected $fillable = [
        'stock',
        'branch_id',
        'product_id'
    ];

    protected $guarded = [
        'id'
    ];

    public function branch(){
        return $this->belongsTo(Branch::class);
    }

    public function product(){
        return $this->belongsTo(Product::class);
    }
}
