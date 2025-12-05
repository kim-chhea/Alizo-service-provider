<?php
use App\Http\Controllers\Backend\ServiceController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
//service route
Route::get('/services', [ServiceController::class, 'index']); 
Route::get('/services/{id}', [ServiceController::class, 'show']);
Route::post('/services', [ServiceController::class, 'store']); 
Route::put('/services/{id}', [ServiceController::class, 'update']);
Route::delete('/services/{id}', [ServiceController::class, 'destroy']);
