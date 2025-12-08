<?php 
use App\Http\Controllers\Backend\DiscountController;
use Illuminate\Support\Facades\Route;
Route::get('/discount', [DiscountController::class, 'index']);
Route::get('/discount/{id}', [DiscountController::class, 'show']);
Route::post('/discount', [DiscountController::class, 'store']);
Route::put('/discount/{id}', [DiscountController::class, 'update']);
Route::delete('/discount/{id}', [DiscountController::class, 'destroy']);
// Route::post('/discount/services', [DiscountController::class, 'CreateDiscountWithServices']);
