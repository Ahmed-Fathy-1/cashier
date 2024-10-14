<?php


use App\Http\Controllers\SuperAdmin\Api\Auth\AuthController;
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

// auth for each sub-doman
Route::group(['prefix' => "auth"],function (){
    Route::post('register',[AuthController::class,'register']);
    Route::post('login',[AuthController::class,'login']);
});

Route::middleware('auth:sanctum')->get('/auth', function (Request $request) {
        Route::post('/logout',[AuthController::class,'logout']);
});

Route::group(['middleware' => 'auth:sanctum'],function (){
    Route::group(['prefix' => "auth"],function (){
        Route::post('logout',[AuthController::class,'logout']);
    });
});







