<?php


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\SuperAdmin\FAQController;
use App\Http\Controllers\Api\SuperAdmin\FeedBacksController;
use App\Http\Controllers\Api\SuperAdmin\TechnologyController;
use App\Http\Controllers\Api\SuperAdmin\HomeCoverController;

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

Route::get('/homecover/{id}', [HomeCoverController::class, 'show']);
Route::get('/faqs', [FAQController::class, 'index']);
Route::get('/feedbacks', [FeedBacksController::class, 'index']);
Route::get('/feedbacks/deleted', [FeedBacksController::class, 'deletedFeedbacks']);
Route::get('/technologies', [TechnologyController::class, 'index']);
Route::get('/technologies/deleted', [TechnologyController::class, 'deletedTechnologies']);



Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});










