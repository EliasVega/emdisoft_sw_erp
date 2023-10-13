<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Ncpurchase extends Model
{
    use HasFactory;

    public $table = 'ncpurchases';

    protected $primaryKey = 'id';

    public $timestamps = true;

    protected $fillable = [
        'document',
        'retention',
        'total',
        'total_tax',
        'total_pay',
        'note',
        'user_id',
        'branch_id',
        'purchase_id',
        'provider_id',
        'resolution_id',
        'discrepancy_id',
        'voucher_type_id'
    ];

    protected $guarded = [
        'id'
    ];



    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function purchase(){
        return $this->belongsTo(Purchase::class);
    }

    public function third(){
        return $this->belongsTo(Provider::class, 'provider_id');
    }

    public function products(){
        return $this->belongsToMany(Product::class);
    }

    public function discrepancy(){
        return $this->belongsTo(Discrepancy::class);
    }

    public function resolution(){
        return $this->belongsTo(Resolution::class);
    }

    public function taxes(): MorphMany
    {
        return $this->morphMany(Tax::class, 'taxable');
    }
}
