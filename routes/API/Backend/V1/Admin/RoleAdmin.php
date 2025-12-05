<?php 
use App\Http\Controllers\Backend\RoleController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
//role route
Route::get('/roles', [RoleController::class, 'index']); // View all roles
Route::get('/roles/{id}', [RoleController::class, 'show']); // View one role
Route::post('/roles', [RoleController::class, 'store']); // Create role (optional)
Route::put('/roles/{id}', [RoleController::class, 'update']); // Update role (optional)
Route::delete('/roles/{id}', [RoleController::class, 'destroy']); // Delete role
Route::post('/users/roles/', [RoleController::class, 'assignRoleToUser']);// Assign role to user
// ->middleware('IsAdmin')
Route::delete('/users/{userId}/roles/{roleId}', [RoleController::class, 'removeRole'])->middleware('IsAdmin');// Remove role from user