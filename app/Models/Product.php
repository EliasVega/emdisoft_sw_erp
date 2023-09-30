<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    public $table = 'products';

    protected $primaryKey = 'id';

    public $timestamps = true;

    protected $fillable = [
        'code',
        'name',
        'price',
        'sale_price',
        'stock',
        'type_product',
        'status',
        'image',
        'category_id',
        'unit_measure_id'
    ];

    protected $guarded = [
        'id'
    ];

    public function branchs()
    {
        return $this->belongsToMany(Branch::class);
    }

    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function measureUnit(){
        return $this->belongsTo(MeasureUnit::class);
    }

    public function branchProduct(){
        return $this->belongsTo(BranchProduct::class);
    }

    public function productBranch(){
        return $this->belongsTo(ProductBranch::class);
    }

    public function kardexes(){
        return $this->hasMany(Kardex::class);
    }

    public function ncpurchaseProduct(){
        return $this->belongsTo(NcpurchaseProduct::class);
    }

    public function ndpurchaseProduct(){
        return $this->belongsTo(NdpurchaseProduct::class);
    }
}
