<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;



class AddProductController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'actual_price' => 'required|numeric',
            'discount' => 'required|numeric',
            'discounted_price' => 'required|numeric',
            'description' => 'required|string',
            'rating' => 'required|numeric',
            'category_id' => 'required|exists:categories,id',
            'image_url' => 'required|image|mimes:jpg,jpeg,png,svg|max:2048',
        ]);

        $product = new Product();
        $product->name = $request->name;
        $product->actual_price = $request->actual_price;
        $product->discount = $request->discount;
        $product->discounted_price = $request->discounted_price;
        $product->description = $request->description;
        $product->rating = $request->rating;
        $product->colors = $request->colors;
        $product->category_id = $request->category_id;
        
        
        if ($request->hasFile('image_url')) {
            $image = $request->file('image_url');
            $image_path = $image->store('', 'public');
            $product->image_url = $image_path;
        }
        // Save the product to the database
        $product->save();
        return redirect()->route('products.index')->with('success', 'Product added successfully!');
    }
}
