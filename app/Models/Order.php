<?php

namespace App\Models;

use App\Models\OrderProduct;
use App\Models\Product;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'user_id',
        'address',
        'payment_method',
        'phone_number',
        'postal_code',
        'grand_total',
        'description', // Add this line
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function products()
    {
        return $this->belongsToMany(Product::class)->withPivot('quantity', 'price', 'size');
    }

    public function order_products()
    {
        return $this->hasMany(OrderProduct::class);
    }
}

