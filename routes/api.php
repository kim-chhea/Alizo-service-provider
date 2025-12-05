<?php
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Auth Routes (Public - No authentication required)
// require __DIR__ . '/AuthAPI.php';

// API Version 1 Routes
Route::prefix('allizo/v1')->group(function () {
    
    // Admin Routes (Protected)
    // Route::middleware(['auth:sanctum'])->prefix('admin')->group(function () {
    //     require __DIR__ . '/API/Backend/V1/Admin/RoleAdmin.php';
    // });
    
    // User Routes (Protected)
    // Route::middleware(['auth:sanctum'])->group(function () {
        require __DIR__ . '/API/Backend/V1/Admin/RoleAdmin.php';
        require __DIR__ . '/API/Backend/V1/Users/BookingApi.php';
        require __DIR__ . '/API/Backend/V1/Users/CategoriesApi.php';
        require __DIR__ . '/API/Backend/V1/Users/LocationApi.php';
        require __DIR__ . '/API/Backend/V1/Users/PaymentApi.php';
        require __DIR__ . '/API/Backend/V1/Users/ReviewApi.php';
        require __DIR__ . '/API/Backend/V1/Users/ServiceApi.php';
        require __DIR__ . '/API/Backend/V1/Users/UserApi.php';
        require __DIR__ . '/API/Backend/V1/Users/WishLishApi.php';
    // });
});

