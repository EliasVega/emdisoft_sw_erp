<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class RawMaterial extends Model
{
    use HasFactory;

    public $table = 'raw_materials';

    protected $primaryKey = 'id';

    public $timestamps = true;

    protected $fillable = [
        'code',
        'name',
        'price',
        'stock',
        'type_product',
        'status',
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

    public function kardexes(): MorphMany
    {
        return $this->morphMany(Kardex::class, 'kardexable');
    }

    public function ncpurchaseProduct(){
        return $this->belongsTo(NcpurchaseProduct::class);
    }

    public function ndpurchaseProduct(){
        return $this->belongsTo(NdpurchaseProduct::class);
    }

    public function ncinvoiceProduct(){
        return $this->belongsTo(NcinvoiceProduct::class);
    }

    public function ndinvoiceProduct(){
        return $this->belongsTo(NdinvoiceProduct::class);
    }

    public function commandRawmaterials(){
        return $this->hasMany(CommandRawmaterial::class);
    }

    public function purchaseOrders(){
        return $this->hasMany(PurchaseOrder::class);
    }

    public function purchases(){
        return $this->hasMany(PurchaseOrder::class);
    }
}
