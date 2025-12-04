<?php

use App\Http\Controllers\Auth\UserAuthController;
use App\Http\Controllers\Auth\SellerAuthController;
use App\Http\Controllers\User\ProductController as UserProductController;
use App\Http\Controllers\User\CartController;
use App\Http\Controllers\User\CheckoutController;
use App\Http\Controllers\Seller\DashboardController;
use App\Http\Controllers\Seller\ProductController as SellerProductController;
use App\Http\Controllers\Seller\OrderController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

// Home page
Route::get('/', function () {
    return Inertia::render('Home');
});

// User Authentication Routes
Route::prefix('user')->group(function () {
    Route::get('/login', [UserAuthController::class, 'showLogin'])->name('user.login');
    Route::post('/login', [UserAuthController::class, 'login']);
    Route::get('/register', [UserAuthController::class, 'showRegister'])->name('user.register');
    Route::post('/register', [UserAuthController::class, 'register']);
    Route::post('/logout', [UserAuthController::class, 'logout'])->name('user.logout');
});

// Seller Authentication Routes
Route::prefix('seller')->group(function () {
    Route::get('/login', [SellerAuthController::class, 'showLogin'])->name('seller.login');
    Route::post('/login', [SellerAuthController::class, 'login']);
    Route::get('/register', [SellerAuthController::class, 'showRegister'])->name('seller.register');
    Route::post('/register', [SellerAuthController::class, 'register']);
    Route::post('/logout', [SellerAuthController::class, 'logout'])->name('seller.logout');
});

// Shop Routes (User)
Route::prefix('shop')->middleware('auth')->group(function () {
    Route::get('/', [UserProductController::class, 'index'])->name('shop.index');
    Route::get('/product/{slug}', [UserProductController::class, 'show'])->name('shop.product');
    
    // Cart
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');
    Route::patch('/cart/{item}', [CartController::class, 'update'])->name('cart.update');
    Route::delete('/cart/{item}', [CartController::class, 'remove'])->name('cart.remove');
    
    // Checkout
    Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');
    Route::post('/checkout', [CheckoutController::class, 'store'])->name('checkout.store');
    Route::get('/orders', [CheckoutController::class, 'orders'])->name('orders.index');
});

// Seller Dashboard Routes
Route::prefix('seller')->middleware('seller')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('seller.dashboard');
    
    // Products
    Route::get('/products', [SellerProductController::class, 'index'])->name('seller.products.index');
    Route::get('/products/create', [SellerProductController::class, 'create'])->name('seller.products.create');
    Route::post('/products', [SellerProductController::class, 'store'])->name('seller.products.store');
    Route::get('/products/{product}/edit', [SellerProductController::class, 'edit'])->name('seller.products.edit');
    Route::post('/products/{product}', [SellerProductController::class, 'update'])->name('seller.products.update');
    Route::delete('/products/{product}', [SellerProductController::class, 'destroy'])->name('seller.products.destroy');
    
    // Orders
    Route::get('/orders', [OrderController::class, 'index'])->name('seller.orders.index');
    Route::get('/orders/{order}', [OrderController::class, 'show'])->name('seller.orders.show');
});
