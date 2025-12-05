<?php 
use App\Http\Controllers\Backend\ReviewController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
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
