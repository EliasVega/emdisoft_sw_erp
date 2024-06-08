<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ApiResponse extends Model
{
    use HasFactory;

    public $table = 'api_responses';

    protected $primaryKey = 'id';

    public $timestamps = true;

    protected $responceApi = [
        'response_api' => 'array'
    ];

    protected $fillable = [
        'document',
        'response_api'
    ];

    protected $guarded = [
        'id'
    ];
}
