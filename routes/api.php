<?php

use App\Http\Controllers\MovieContoller;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ActController;
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

// public routes
// movies
Route::get('/movies', [MovieContoller::class, 'index']);
Route::get('/movies/{id}', [MovieContoller::class, 'show']);
Route::get('/movies/search/{name}', [MovieContoller::class, 'search']);
// users
Route::post('/users', [UserController::class, 'register']);
Route::post('/users/login', [UserController::class, 'login']);
// acts
Route::get('/acts', [ActController::class, 'index']);
Route::get('/acts/{id}', [ActController::class, 'show']);
Route::get('/acts/search/{name}', [ActController::class, 'search']);
// resource
// Route::resource('movies', MovieContoller::class);

// protected routes
Route::group(['middleware' => 'auth:sanctum'], function(){
    Route::post('/movies', [MovieContoller::class, 'store']);
    Route::put('/movies/{id}', [MovieContoller::class, 'update']);
    Route::delete('/movies/{id}', [MovieContoller::class, 'destory']);
    Route::post('/movies/{id}/add-act', [MovieContoller::class, 'addAct']);
    Route::post('/acts/{id}/add-movie', [ActController::class, 'addMovie']);
});
