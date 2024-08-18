<?php

namespace App\Livewire;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Event;
use Livewire\Component;
use App\Models\Category;
use App\Models\Product;
use App\Models\Cart;
use Illuminate\Support\Facades\Auth;

class CategorySelector extends Component
{
    public $categories;
    public $selectedCategoryId;
    public $products;
    public $selectedSize;
    public $quantities = []; // Array to store quantities for each product
   
    public function mount($products)
    {
        // Fetch all categories from the database
        $this->categories = Category::all();
        // Set initial products
        $this->products = $products; 
        // Initialize quantities array with default value of 1 for each product
        foreach ($this->products as $product) {
            $this->quantities[$product->id] = 1;
        }
    }
    

    public function selectCategory($categoryId)
    {
        // Update the selected category ID
        $this->selectedCategoryId = $categoryId;
        // Fetch products of the selected category
        $this->products = Product::where('category_id', $categoryId)->get();
    }
    
    public function addToCart($productId)
    {
        // Check if the user is logged in
        if (!Auth::check()) {
            // Redirect to the register page if the user is not logged in
            return redirect()->route('register');
        }
    
        // Find the product
        $product = Product::findOrFail($productId);
    
        // Set default size to "xs" only for products where category is "Stitched"
        if ($product->category->name == 'Stitched' && is_null($this->selectedSize)) {
            $this->selectedSize = 'xs';
        }
    
        // Find or create the cart for the current user
        $cart = Cart::where('user_id', auth()->id())->firstOrCreate(['user_id' => auth()->id()]);
    
        // Retrieve the existing cart item with the same product ID and size
        $existingCartItem = $cart->products()->wherePivot('product_id', $productId)->wherePivot('size', $this->selectedSize)->first();
    
        // If no existing cart item with the same product ID and size, create a new entry
        if (!$existingCartItem) {
            $cart->products()->attach($product, [
                'size' => $this->selectedSize,
                'quantity' => $this->quantities[$productId] ?? 1
            ]);
        } else {
            // If the same product with the same size is already in the cart, retrieve the previous quantity
            $previousQuantity = $existingCartItem->pivot->quantity;
    
            // Add the new quantity to the previous quantity
            $newQuantity = $previousQuantity + ($this->quantities[$productId] ?? 1);
    
            // Update the quantity in the pivot table
            $cart->products()->updateExistingPivot($productId, [
                'quantity' => $newQuantity
            ]);
        }
    
        // Emit an event to inform other components about the cart update
        Event::dispatch('cartUpdated');
    
        // Reset the selected size
        $this->selectedSize = null;
    }

   
    

    public function render()
    {
        // Render the Livewire component view
        return view('livewire.category-selector');
    }
}
