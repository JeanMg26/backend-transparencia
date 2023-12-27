<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SubcategoryController;
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
  Route::put('user/reset/{id}', [UserController::class, 'resetPasswordUser']);
  Route::delete('user/{id}', [UserController::class, 'deleteUser']);
  Route::put('user/status/{id}', [UserController::class, 'changeStatusUser']);
  // ++ Categories
  Route::post('cat', [CategoryController::class, 'createCat']);
  Route::get('cat/{id}', [CategoryController::class, 'getCat']);
  Route::put('cat/{id}', [CategoryController::class, 'updateCat']);
  Route::delete('cat/{id}', [CategoryController::class, 'deleteCat']);
  // ++ Articles
  Route::post('article', [ArticleController::class, 'createArticle']);
  Route::put('article/{id}', [ArticleController::class, 'updateArticle']);
  Route::delete('article/{id}', [ArticleController::class, 'deleteArtitcle']);
  // ++ Profile
  Route::get('profile', [ProfileController::class, 'getProfile']);
  Route::put('profile', [ProfileController::class, 'updateProfile']);
});

// ++ Categories
Route::get('cats', [CategoryController::class, 'listCat']);
Route::get('articles', [ArticleController::class, 'listArticle']);
Route::get('article/{id}', [ArticleController::class, 'gettArticle']);
