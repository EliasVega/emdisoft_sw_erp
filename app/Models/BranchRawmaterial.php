<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BranchRawmaterial extends Model
{
    use HasFactory;

    public $table = 'branch_rawmaterials';

    public $timestamps = true;

    protected $fillable = [
        'stock',
        'branch_id',
        'raw_material_id'
    ];

    protected $guarded = [
        'id'
    ];

    public function branch(){
        return $this->belongsTo(Branch::class);
    }

    public function rawMaterial(){
        return $this->belongsTo(RawMaterial::class);
    }
}
