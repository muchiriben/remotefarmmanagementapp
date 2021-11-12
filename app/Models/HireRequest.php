<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HireRequest extends Model
{
    use HasFactory;

    protected $fillable = [
        'urban_farmer_id',
        'rural_farmer_id',
        'status',
    ];
}
