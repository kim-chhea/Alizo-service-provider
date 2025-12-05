<?php 
use App\Http\Controllers\Backend\BookingController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
//Booking route
Route::get('/booking', [BookingController::class, 'index']);
Route::get('/booking/{id}', [BookingController::class, 'show']);
Route::post('/booking', [BookingController::class, 'store']); 
Route::put('/booking/{id}', [BookingController::class, 'update']); 
Route::delete('/booking/{id}', [BookingController::class, 'destroy']);//booking management 
Route::post('/booking/{bookingId}/service/{serviceId}', [BookingController::class, 'addService']);
Route::delete('/booking/{bookingId}/service/{serviceId}', [BookingController::class, 'removeService']);
Route::post('/booking/checkout', [BookingController::class, 'checkoutFromCart']);