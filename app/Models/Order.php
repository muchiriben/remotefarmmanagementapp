<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'order',
        'product_slug',
        'product_name',
        'quantity',
        'price',
        'total',
    ];

    public function customers()
    {
        return $this->belongsToMany('App\Models\User');
    }
}
