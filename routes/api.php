<?php

use App\Http\Controllers\CompanyController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\UserAdministratorController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


// User
Route::post('user/login', [UserAdministratorController::class, 'login']);
Route::post('user/create', [UserAdministratorController::class, 'store']);

//Company
Route::resource('companies', CompanyController::class);

//Employee
Route::resource('employees', EmployeeController::class);
