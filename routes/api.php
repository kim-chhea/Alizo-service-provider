<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DiscountController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WishlistController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::prefix('/user')->group(function(){
Route::post('/login',[AuthController::class , 'login']);
Route::post('/register',[AuthController::class , 'register']);
Route::delete('/logout',[AuthController::class , 'logout']);
});
//user route
Route::prefix('/allizo')->group(function(){
Route::apiResource('/users',UserController::class)->middleware('IsLogin');
//location route
Route::get('/locations',[LocationController::class,'index']);
Route::get('/locations/{id}',[LocationController::class,'show']);
Route::post('/locations',[LocationController::class,'store'])->middleware('IsUser');
Route::put('/locations/{id}',[LocationController::class,'update'])->middleware('IsUser');
Route::delete('/locations/{id}',[LocationController::class,'destroy'])->middleware('IsUser');

//role route
Route::get('/roles', [RoleController::class, 'index'])->middleware('IsAdmin'); // View all roles
Route::get('/roles/{id}', [RoleController::class, 'show'])->middleware('IsAdmin'); // View one role
Route::post('/roles', [RoleController::class, 'store'])->middleware('IsAdmin'); // Create role (optional)
Route::put('/roles/{id}', [RoleController::class, 'update'])->middleware('IsAdmin'); // Update role (optional)
Route::delete('/roles/{id}', [RoleController::class, 'destroy'])->middleware('IsAdmin'); // Delete role

// User-Role Management
Route::post('/users/{userId}/roles/{roleId}', [RoleController::class, 'assignRole'])->middleware('IsAdmin');// Assign role to user
Route::delete('/users/{userId}/roles/{roleId}', [RoleController::class, 'removeRole'])->middleware('IsAdmin');// Remove role from user

//Review
Route::get('/reviews',[ReviewController::class,'index']);
Route::get('/reviews/{id}',[ReviewController::class,'show'])->middleware('IsUser');
Route::post('/reviews',[ReviewController::class,'store'])->middleware('IsUser');
Route::put('/reviews/{id}',[ReviewController::class,'update'])->middleware('IsUser');
Route::delete('/reviews/{id}',[ReviewController::class,'destroy'])->middleware('IsUser');

//view reviews base on service
Route::get('/services/{serviceId}/reviews',[ReviewController::class,'reviewBaseOnId']);
//review to service
Route::post('/services/{serviceId}/reviews',[ReviewController::class,'review'])->middleware('IsUser');

//categories route
Route::get('/categories', [CategoryController::class, 'index']);
Route::get('/categories/{id}', [CategoryController::class, 'show']);
Route::post('/categories', [CategoryController::class, 'store'])->middleware('IsOwner');
Route::put('/categories/{id}', [CategoryController::class, 'update'])->middleware('IsOwner');
Route::delete('/categories/{id}', [CategoryController::class, 'destroy'])->middleware('IsAdmin');

//
//service route
Route::get('/services', [ServiceController::class, 'index']); 
Route::get('/services/{id}', [ServiceController::class, 'show']);
Route::post('/services', [ServiceController::class, 'store'])->middleware('IsOwner'); 
Route::put('/services/{id}', [ServiceController::class, 'update'])->middleware('IsOwner');
Route::delete('/services/{id}', [ServiceController::class, 'destroy'])->middleware('IsOwner');

//Route cart
Route::get('/carts', [CartController::class, 'index'])->middleware('IsAdmin'); 
Route::get('/carts/{id}', [CartController::class, 'show'])->middleware('IsUser');
Route::post('/carts', [CartController::class, 'store'])->middleware('IsAdmin'); 
Route::put('/carts/{id}', [CartController::class, 'update'])->middleware('IsAdmin'); 
Route::delete('/carts/{id}', [CartController::class, 'destroy'])->middleware('IsAdmin');

//cart managements
Route::post('/cart/{cartId}/service', [CartController::class, 'addToCart'])->middleware('IsUser');
Route::delete('/cart/{cartId}/service', [CartController::class, 'removeService'])->middleware('IsUser');

//route wishlist
Route::get('/wishlist', [WishlistController::class, 'index'])->middleware('IsAdmin'); 
Route::get('/wishlist/{id}', [WishlistController::class, 'show'])->middleware('IsUser');
Route::post('/wishlist', [WishlistController::class, 'store'])->middleware('IsUser'); 
Route::put('/wishlist/{id}', [WishlistController::class, 'update'])->middleware('IsUser'); 
Route::delete('/wishlist/{id}', [WishlistController::class, 'destroy'])->middleware('IsAdmin');

//wishlist managements
Route::post('/wishlist/{wishlistId}/service', [WishlistController::class, 'addService'])->middleware('IsUser');
Route::delete('/wishlist/{wishlistId}/service', [WishlistController::class, 'removeService'])->middleware('IsUser');

//Booking route
Route::get('/booking', [BookingController::class, 'index'])->middleware('IsAdmin'); 
Route::get('/booking/{id}', [BookingController::class, 'show'])->middleware('IsUser');
Route::post('/booking', [BookingController::class, 'store'])->middleware('IsUser'); 
Route::put('/booking/{id}', [BookingController::class, 'update'])->middleware('IsUser'); 
Route::delete('/booking/{id}', [BookingController::class, 'destroy'])->middleware('IsAdmin');
//booking management 
Route::post('/booking/{bookingId}/service/{serviceId}', [BookingController::class, 'addService'])->middleware('IsUser');
Route::delete('/booking/{bookingId}/service/{serviceId}', [BookingController::class, 'removeService'])->middleware('IsUser');
Route::post('/booking/checkout', [BookingController::class, 'checkoutFromCart'])->middleware('IsUser');
//payment route
Route::get('/payment', [PaymentController::class, 'index'])->middleware('IsAdmin'); 
Route::get('/payment/{id}', [PaymentController::class, 'show'])->middleware('IsUser');
Route::post('/payment', [PaymentController::class, 'store'])->middleware('IsUser'); 
Route::put('/payment/{id}', [PaymentController::class, 'update'])->middleware('IsUser'); 
Route::delete('/payment/{id}', [PaymentController::class, 'destroy'])->middleware('IsUser');

Route::post('/payment/checkout',[PaymentController::class,'payment'])->middleware('IsUser');

//order route
Route::get('order', [OrderController::class, 'index'])->middleware('IsAdmin'); 
Route::get('order/{id}', [OrderController::class, 'show'])->middleware('IsUser');
Route::post('order', [OrderController::class, 'store'])->middleware('IsUser'); 
Route::put('order/{id}', [OrderController::class, 'update'])->middleware('IsUser'); 
Route::delete('order/{id}', [OrderController::class, 'destroy'])->middleware('IsUser');
Route::get('order/receipt', [OrderController::class, 'getReceipt'])->middleware('IsUser');
});



