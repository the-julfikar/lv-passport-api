<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\UserController;

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

// Routes
Route::post('/passport/reg',[UserController::class,'registration']);
Route::post('/passport/login',[UserController::class,'login']);
Route::get('/passport/login',[UserController::class,'login']);

// Route::get('/restapis',[UserController::class,'restapis']);
Route::middleware('auth:api')->get('/restapis',[UserController::class,'restapis']);