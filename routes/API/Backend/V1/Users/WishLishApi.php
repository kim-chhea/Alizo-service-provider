<?php 
use App\Http\Controllers\Backend\WishlistController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
//route wishlist
Route::get('/wishlist', [WishlistController::class, 'index']); 
Route::get('/wishlist/{id}', [WishlistController::class, 'show']);
Route::post('/wishlist', [WishlistController::class, 'store']); 
Route::put('/wishlist/{id}', [WishlistController::class, 'update']); 
Route::delete('/wishlist/{id}', [WishlistController::class, 'destroy']);//wishlist managements
Route::post('/wishlist/{wishlistId}/service', [WishlistController::class, 'addService'])->middleware('IsUser');
Route::delete('/wishlist/{wishlistId}/service', [WishlistController::class, 'removeService'])->middleware('IsUser');