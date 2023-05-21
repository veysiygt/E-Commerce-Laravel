<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\EmployeeController;
use App\Http\Controllers\Api\CustomerController;
use App\Http\Controllers\Api\CategoryController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('auth')->group(function () {
    Route::post('admin-register', [AuthController::class, 'registerAdmin']);
    Route::post('admin-login', [AuthController::class, 'loginAdmin']);
    Route::post('admin-logout', [AuthController::class, 'logOutAdmin']);

});
Route::group(['prefix' => 'customer'], function () {
    Route::post('customer-register', [CustomerController::class, 'registerCustomer']);
    Route::post('customer-login', [CustomerController::class, 'loginCustomer']);
    Route::post('customer-logout', [AuthController::class, 'logOutCustomer']);
});
Route::group(['prefix' => 'employee'], function () {
    Route::post('employee-register', [EmployeeController::class, 'registerEmployee']);
    Route::post('employee-login', [EmployeeController::class, 'loginEmployee']);
    Route::post('employee-logout', [AuthController::class, 'logOutEmployee']);
});

Route::group(['prefix' => 'categories'], function () {
    Route::post('category-create', [CategoryController::class, 'createCategory'])->name('createCategory');
    Route::put('category-update/{id}', [CategoryController::class, 'updateCategory'])->name('updateCategory');
    Route::delete('delete-category/{id}', [CategoryController::class, 'deleteCategory'])->name('deleteCategory');
});








