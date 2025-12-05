<?php 
use App\Http\Controllers\Backend\CategoryController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
Route::get('/categories', [CategoryController::class, 'index']);
Route::get('/categories/{id}', [CategoryController::class, 'show']);
Route::post('/categories', [CategoryController::class, 'store']);
Route::put('/categories/{id}', [CategoryController::class, 'update']);
Route::delete('/categories/{id}', [CategoryController::class, 'destroy']);
Route::post('/categories/services', [CategoryController::class, 'CreateCategoryWithServices']);
