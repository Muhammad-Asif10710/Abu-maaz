<?php

// app/Http/Controllers/AdminLoginController.php

namespace App\Http\Controllers;
use App\Models\Order;
use App\Models\User;
use App\Models\OrderProduct;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\Admin; // Update to use the Admin model
use Illuminate\Support\Facades\Auth; // Update to use the Auth facade
use Illuminate\Support\Facades\DB;
class AdminLoginController extends Controller
{
    public function showLoginForm()
    {
        return view('adminlogin');
    }

    public function login(Request $request)
    {
        $email = $request->input('email');
        $password = $request->input('password');

        // Attempt to authenticate the admin user
        if (Auth::guard('admin')->attempt(['email' => $email, 'password' => $password])) {
            // Authentication successful, redirect to dashboard
            return redirect()->route('admin.dashboard');
        } else {
            // Authentication failed, redirect back with error message
            return back()->withErrors(['email' => 'Invalid credentials']);
        }
    }
    public function dashboard()
    {
        $orders = Order::with('order_products')->get();
        $users = User::all();
        $products = Product::all();
        
        return view('admin.dashboard', [
            'orders' => $orders,
            'users' => $users,
            'products' => $products,
        ]);
    }
    


    public function addproduct()
{
    $categories = Category::all(); // or however you're fetching categories
return view('addtoproduct', compact('categories'));
}
}