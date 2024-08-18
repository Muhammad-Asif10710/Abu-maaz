<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CartProduct extends Model
{
    use HasFactory;

    protected $table = 'cart_product'; // Set the table name explicitly

    protected $fillable = [
        'cart_id',
        'product_id',
        'size',
        'quantity',
    ];

    // Define the relationship with the Cart model
    public function cart()
    {
        return $this->belongsTo(Cart::class);
    }

    // Define the relationship with the Product model
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}

