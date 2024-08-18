<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;

class WelcomeController extends Controller
{
    public function index(Request $request)
    {
        $query = $request->input('query');
        if (!$query) {
            $products = Product::all(); // Retrieve all products
        } else {
            $products = Product::where('name', 'like', "%{$query}%")->get(); // Retrieve searched products
        }
        return view('welcome', compact('products'));
    }
   
}
