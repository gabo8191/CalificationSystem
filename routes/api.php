<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\UsersController;
use Illuminate\Http\Request;
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
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Route::group([
//     'prefix' => 'auth'
// ], function () {
//     Route::post('login', [AuthController::class, 'login'])->name('login');
//     Route::post('signup', [AuthController::class, 'signUp'])->name('signup');

//     Route::group([
//         'middleware' => 'auth:api'
//     ], function () {
//         Route::get('logout', [AuthController::class, 'logout'])->name('logout');
        
//         Route::get('user', [UsersController::class, 'allUser'])->name('userAll');
//         Route::get('user/{id}', [UsersController::class, 'show'])->name('userShow');
//         Route::put('user/{id}', [UsersController::class, 'update'])->name('userUpdate');
//         Route::delete('user/{id}', [UsersController::class, 'destroy'])->name('userDestroy');
//     });
// });
