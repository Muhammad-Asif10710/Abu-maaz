<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Cart;
use App\Models\OrderProduct;
use App\Models\CartProduct;

class CheckoutController extends Controller
{
    public function showDetails(Request $request)
    {
        // Retrieve the form data
        $productIds = $request->input('product_id');
        $productNames = $request->input('product_name');
        $quantities = $request->input('quantity');
        $sizes = $request->input('size');
        
        $cart = Cart::where('user_id', auth()->user()->id)->first();
        $grandTotal = $cart->grand_total;
        
        // Store the data in the session
        $request->session()->put('orderData', [
            'productIds' => $productIds,
            'productNames' => $productNames,
            'quantities' => $quantities,
            'sizes' => $sizes,
            'grandTotal' => $grandTotal,
        ], 120);
        $request->session()->regenerate();
        
        // Pass the data to the view
        return view('checkout-details', [
            'grandTotal' => $grandTotal,
        ]);
    }
    public function placeOrder(Request $request)
    {
        // Retrieve the data from the session
        $orderData = $request->session()->get('orderData');
        
        // Define validation rules
        $rules = [
            'address' => 'required|string',
            'payment_method' => 'required|string',
            'phone_number' => 'required|numeric|min:11',
            'postal_code' => 'required|numeric',
            'description' => 'required|string',
        ];
    
        // Validate the request data
        $validator = Validator::make($request->all(), $rules);
        
        // If validation fails, redirect back with errors
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
    
        // Create a new order
        $order = Order::create([
            'user_id' => $request->user()->id,
            'grand_total' => $orderData['grandTotal'], // Add the grand total to the order
        ]);
        
        // Loop through the product IDs and create a new OrderProduct instance for each
        foreach ($orderData['productIds'] as $index => $productId) {
            $orderProduct = new OrderProduct();
            $orderProduct->order_id = $order->id;
            $orderProduct->product_id = $productId;
            $orderProduct->quantity = $orderData['quantities'][$index];
            if (isset($orderData['sizes'][$index])) {
                $orderProduct->size = $orderData['sizes'][$index];
            } else {
                $orderProduct->size = ''; // Set a default value if the key doesn't exist
            }
            $orderProduct->save();
        }
        
        // Update the order attributes
        $order->address = $request->input('address');
        $order->payment_method = $request->input('payment_method');
        $order->phone_number = $request->input('phone_number');
        $order->postal_code = $request->input('postal_code');
        $order->description = $request->input('description');
        $order->save();
    
        // Clear all cart items affiliated with the user
        $userId = Auth::id();
        CartProduct::whereHas('cart', function ($query) use ($userId) {
            $query->where('user_id', $userId);
        })->delete();
    
        // Clear the session data
        $request->session()->forget('orderData');
    
        // Redirect to a success page or wherever you need
        return redirect()->route('success');
    }
}