<?php 
use App\Http\Controllers\Backend\PaymentController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
//payment route
Route::get('/payment', [PaymentController::class, 'index']);
Route::get('/payment/{id}', [PaymentController::class, 'show'])->middleware('IsUser');
Route::post('/payment', [PaymentController::class, 'store'])->middleware('IsUser'); 
Route::put('/payment/{id}', [PaymentController::class, 'update'])->middleware('IsUser'); 
Route::delete('/payment/{id}', [PaymentController::class, 'destroy'])->middleware('IsUser');
Route::post('/payment/checkout',[PaymentController::class,'payment'])->middleware('IsUser');