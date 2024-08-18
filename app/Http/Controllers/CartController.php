<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use Illuminate\Support\Facades\Auth;
use App\Models\CartProduct; 
use App\Models\Product;
use Illuminate\Support\Facades\Validator;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Get the ID of the authenticated user
        $userId = Auth::id();
        
        // Fetch the cart belonging to the authenticated user
        $cart = Cart::where('user_id', $userId)->first();
        
        // Fetch all products affiliated with the cart
        $cartProducts = CartProduct::where('cart_id', $cart->id)->get();
        
        // Check if there are no products in the cart
        if ($cartProducts->isEmpty()) {
            return view('usercart', ['message' => 'No products in cart', 'cartProducts' => [], 'grandTotal' => 0]);
        }
        
        // Calculate subtotal and grand total
        $subtotals = [];
        $grandTotal = 0;
        foreach ($cartProducts as $cartProduct) {
            $subtotal = $cartProduct->product->actual_price * $cartProduct->quantity;
            $cartProduct->subtotal = $subtotal; // Add subtotal to the cart product object
            $subtotals[] = $subtotal;
            $grandTotal += $subtotal;
        }
        
        // Save the grand total to the cart
        $cart->grand_total = $grandTotal;
        $cart->save();
        
        // Pass the cart products, subtotals, and grand total to the view
        return view('usercart', compact('cartProducts', 'subtotals', 'grandTotal'));
    }
    
    public function updateCart(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'product_id' => 'required|numeric',
            'quantity' => 'required|numeric|min:1',
        ]);

        if ($validator->fails()) {
            $errorMessages = $validator->messages()->all();
            foreach ($errorMessages as $message) {
                console.log($message);
            }
            return response()->json(['error' => 'Validation failed'], 400);
        }

        $productId = $request->input('product_id');
        $quantity = $request->input('quantity');
        // Update the cart logic here
        $cart = Cart::where('user_id', Auth::id())->first();
        $cartProduct = CartProduct::where('cart_id', $cart->id)
            ->where('product_id', $productId)
            ->first();
        $cartProduct->quantity = $quantity;
        $cartProduct->save();
        // Update the grand total
        $grandTotal = $this->calculateGrandTotal();
        $subtotal = $cartProduct->product->actual_price * $cartProduct->quantity;
        return response()->json(['cart' => ['grand_total' => $grandTotal, 'subtotal' => $subtotal]]);
    }
    
    private function calculateGrandTotal()
    {
        $cart = Cart::where('user_id', Auth::id())->first();
        $cartProducts = CartProduct::where('cart_id', $cart->id)->get();
        $grandTotal = 0;
        foreach ($cartProducts as $cartProduct) {
            $subtotal = $cartProduct->product->actual_price * $cartProduct->quantity;
            $grandTotal += $subtotal;
        }
        $cart->grand_total = $grandTotal;
        $cart->save();
        return $grandTotal;
    }

    public function deleteFromCart(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'product_id' => 'required|numeric',
        ]);

        if ($validator->fails()) {
            $errorMessages = $validator->messages()->all();
            foreach ($errorMessages as $message) {
                console.log($message);
            }
            return response()->json(['error' => 'Validation failed'], 400);
        }

        $productId = $request->input('product_id');
        $cart = Cart::where('user_id', Auth::id())->first();
        $cartProduct = CartProduct::where('cart_id', $cart->id)
            ->where('product_id', $productId)
            ->first();
        $cartProduct->delete();
        // Update the grand total
        $grandTotal = $this->calculateGrandTotal();
        return response()->json(['usercart' => ['grand_total' => $grandTotal]]);
    }
}