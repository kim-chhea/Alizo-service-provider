<?php 
use App\Http\Controllers\Backend\LocationController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
//location route
Route::get('/locations',[LocationController::class,'index']);
Route::get('/locations/{id}',[LocationController::class,'show']);
Route::post('/locations',[LocationController::class,'store']);
Route::put('/locations/{id}',[LocationController::class,'update']);
Route::delete('/locations/{id}',[LocationController::class,'destroy']);