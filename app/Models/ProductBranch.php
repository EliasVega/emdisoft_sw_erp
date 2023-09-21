<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductBranch extends Model
{
    use HasFactory;

    public $table = 'product_branches';

    protected $primaryKey = 'id';

    public $timestamps = true;

    protected $fillable = [
        'quantity',
        'user_id',
        'product_id',
        'branch_id',
        'origin_branch_id'
    ];


        public function product(){
            return $this->belongsTo(Product::class);
        }

        public function branch(){
            return $this->hasOne(Branch::class);
        }

        public function originBranch(){
            return $this->hasOne(Branch::class);
        }

        public function transfer(){
            return $this->belongsTo(Transfer::class);
        }
}
