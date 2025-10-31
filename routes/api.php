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
Route::apiResource('/users',UserController::class);
// ->middleware('IsLogin')
//location route
Route::get('/locations',[LocationController::class,'index']);
Route::get('/locations/{id}',[LocationController::class,'show']);
Route::post('/locations',[LocationController::class,'store']);
Route::put('/locations/{id}',[LocationController::class,'update']);
Route::delete('/locations/{id}',[LocationController::class,'destroy']);

//role route
Route::get('/roles', [RoleController::class, 'index']); // View all roles
Route::get('/roles/{id}', [RoleController::class, 'show']); // View one role
Route::post('/roles', [RoleController::class, 'store']); // Create role (optional)
Route::put('/roles/{id}', [RoleController::class, 'update']); // Update role (optional)
Route::delete('/roles/{id}', [RoleController::class, 'destroy']); // Delete role
// ->middleware('IsAdmin')
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
Route::post('/categories', [CategoryController::class, 'store']);
Route::put('/categories/{id}', [CategoryController::class, 'update']);
Route::delete('/categories/{id}', [CategoryController::class, 'destroy']);

//
//service route
Route::get('/services', [ServiceController::class, 'index']); 
Route::get('/services/{id}', [ServiceController::class, 'show']);
Route::post('/services', [ServiceController::class, 'store']); 
Route::put('/services/{id}', [ServiceController::class, 'update']);
Route::delete('/services/{id}', [ServiceController::class, 'destroy']);
// ->middleware('IsOwner')

//Route cart
Route::get('/carts', [CartController::class, 'index']); 
Route::get('/carts/{id}', [CartController::class, 'show']);
Route::post('/carts', [CartController::class, 'store']); 
Route::put('/carts/{id}', [CartController::class, 'update']); 
Route::delete('/carts/{id}', [CartController::class, 'destroy']);

//cart managements
Route::post('/cart/{cartId}/service', [CartController::class, 'addToCart'])->middleware('IsUser');
Route::delete('/cart/{cartId}/service', [CartController::class, 'removeService'])->middleware('IsUser');

//route wishlist
Route::get('/wishlist', [WishlistController::class, 'index']); 
Route::get('/wishlist/{id}', [WishlistController::class, 'show']);
Route::post('/wishlist', [WishlistController::class, 'store']); 
Route::put('/wishlist/{id}', [WishlistController::class, 'update']); 
Route::delete('/wishlist/{id}', [WishlistController::class, 'destroy']);

//wishlist managements
Route::post('/wishlist/{wishlistId}/service', [WishlistController::class, 'addService'])->middleware('IsUser');
Route::delete('/wishlist/{wishlistId}/service', [WishlistController::class, 'removeService'])->middleware('IsUser');

//Booking route
Route::get('/booking', [BookingController::class, 'index']);
Route::get('/booking/{id}', [BookingController::class, 'show']);
Route::post('/booking', [BookingController::class, 'store']); 
Route::put('/booking/{id}', [BookingController::class, 'update']); 
Route::delete('/booking/{id}', [BookingController::class, 'destroy']);
//booking management 
Route::post('/booking/{bookingId}/service/{serviceId}', [BookingController::class, 'addService']);
Route::delete('/booking/{bookingId}/service/{serviceId}', [BookingController::class, 'removeService']);
Route::post('/booking/checkout', [BookingController::class, 'checkoutFromCart']);
//payment route
Route::get('/payment', [PaymentController::class, 'index']);
Route::get('/payment/{id}', [PaymentController::class, 'show'])->middleware('IsUser');
Route::post('/payment', [PaymentController::class, 'store'])->middleware('IsUser'); 
Route::put('/payment/{id}', [PaymentController::class, 'update'])->middleware('IsUser'); 
Route::delete('/payment/{id}', [PaymentController::class, 'destroy'])->middleware('IsUser');

Route::post('/payment/checkout',[PaymentController::class,'payment'])->middleware('IsUser');

//order route
Route::get('order', [OrderController::class, 'index']) ;
Route::get('order/{id}', [OrderController::class, 'show'])->middleware('IsUser');
Route::post('order', [OrderController::class, 'store'])->middleware('IsUser'); 
Route::put('order/{id}', [OrderController::class, 'update'])->middleware('IsUser'); 
Route::delete('order/{id}', [OrderController::class, 'destroy'])->middleware('IsUser');
Route::get('order/receipt', [OrderController::class, 'getReceipt'])->middleware('IsUser');
});



