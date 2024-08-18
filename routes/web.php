<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;
use App\Http\Controllers\AddProductController;
use Illuminate\Http\Request;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\AdminLoginController;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\CheckoutController;



Route::get('/', [WelcomeController::class, 'index']
)->name('welcome');
Route::post('/add-to-cart', 'CartController@addToCart')->name('addToCart');
// Register routes
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);
Route::get('/login', [RegisterController::class, 'showLoginForm'])->name('login');

// Route for processing the login form submission
Route::post('/login', [RegisterController::class, 'login']);


// Route for logging out
Route::post('/logout', [RegisterController::class, 'logout'])->name('logout');

Route::get('/search',[WelcomeController::class, 'search'] )->name('products.search');

Route::middleware('auth:web')->group(function () {
    Route::get('/cart', [CartController::class, 'index'])->name('cart.show');
    Route::post('/update-cart',  [CartController::class, 'updateCart'])->name('update-cart');
    Route::post('/checkout', [CheckoutController::class, 'showDetails']);
    Route::post('/place-order', [CheckoutController::class, 'placeOrder'])->name('place-order');
    Route::post('/update-grand-total', [CartController::class, 'updateCart']);
    Route::post('/delete-from-cart', [CartController::class, 'deleteFromCart']);
    Route::get('/success', function () {
        return view('sucess');
    })->name('success');
});
// routes/web.php

Route::post('/admin/login', [AdminLoginController::class, 'login'])->name('admin.login');
// routes/web.php

Route::get('/AbuadminMaaz/login', [AdminLoginController::class, 'showLoginForm'])->name('admin.login.form');

// routes/web.php

Route::get('/admin/dashboard', [AdminLoginController::class, 'dashboard'])->name('admin.dashboard')->middleware('auth:admin');
Route::get('/admin/addproduct', [AdminLoginController::class, 'addproduct'])->name('products.index')->middleware('auth:admin');
Route::post('/productsadd', [AddProductController::class, 'store'])->name('products.store')->middleware('auth:admin');