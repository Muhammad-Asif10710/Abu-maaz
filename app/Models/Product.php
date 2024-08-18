<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'actual_price',
        'discount',
        'discounted_price',
        'description',
        'rating',
        'colors',
        'image_url', 
        'category_id', 
    ];

    protected $casts = [
        'colors' => 'array',
    ];

    /**
     * Get the category that owns the product.
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function carts()
    {
        return $this->belongsToMany(Cart::class)->withPivot('size', 'quantity'); // Include 'quantity' in pivot
    }
}
