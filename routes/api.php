<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Acl\AclController;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\Branch\BranchController;
use App\Http\Controllers\Lookup\LookupController;
use App\Http\Controllers\Series\SeriesController;
use App\Http\Controllers\Employee\EmployeeController;

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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });


Route::group(['middleware' => 'jwt.verify'], function ($router) { 
    Route::group(['prefix' => 'auth'], function () {
        Route::post('/logout', [AuthController::class, 'logout']);
        Route::post('/refresh', [AuthController::class, 'refresh']);
        Route::get('me', [AuthController::class, 'me']); 
        Route::any('user', [UserController::class, 'index']);
        Route::any('acl',  [AclController::class, 'index']);
        Route::any('branch',  [BranchController::class, 'index']);
        Route::any('employee',  [EmployeeController::class, 'index']);
    });
    Route::any('lookup',  [LookupController::class, 'index']);
    Route::any('serial',  [SeriesController::class, 'index']);
});

Route::group(['prefix' => 'auth'], function ($router) {
    Route::post('login', [App\Http\Controllers\AuthController::class, 'login']); 
});