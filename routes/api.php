<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });


Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);

Route::group(['middleware' => ['jwt.verify']], function () {
  Route::get('profile', [AuthController::class, 'getUser']);
  // ++ Users
  Route::post('user', [UserController::class, 'createUser']);
  Route::get('users', [UserController::class, 'getListUsers']);
  Route::get('user/{id}', [UserController::class, 'getUser']);
  Route::put('user/{id}', [UserController::class, 'updateUser']);
  Route::delete('user/{id}', [UserController::class, 'deleteUser']);
});
