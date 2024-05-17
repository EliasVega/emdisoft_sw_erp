<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CostCenter extends Model
{
    use HasFactory;

    public $table = 'cost_centers';

    protected $primaryKey = 'id';

    public $timestamps = true;

    protected $fillable = [
        'code',
        'name',
        'state',
        'branch_id'
    ];

    protected $guarded = [
        'id'
    ];

    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }
}
