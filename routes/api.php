<?php


use App\Http\Controllers\Api\SuperAdmin\aboutUs\AboutUsController;
use App\Http\Controllers\Api\SuperAdmin\FAQController;
use App\Http\Controllers\Api\SuperAdmin\Features\FeatureController;
use App\Http\Controllers\Api\SuperAdmin\FeedBacksController;
use App\Http\Controllers\Api\SuperAdmin\HomeCoverController;
use App\Http\Controllers\Api\SuperAdmin\Needs\MainNeedController;
use App\Http\Controllers\Api\SuperAdmin\Needs\SubNeedsController;
use App\Http\Controllers\Api\SuperAdmin\TechnologyController;
use App\Http\Controllers\Api\SuperAdmin\PaymentController;
use App\Http\Controllers\Api\SuperAdmin\Auth\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\SuperAdmin\PackageController;
use App\Http\Controllers\Api\SuperAdmin\ContactUsController;

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

//auth for each sub-doman
Route::group(['prefix' => "auth"], function () {
    Route::post('register', [AuthController::class, 'register']);
    Route::post('login', [AuthController::class, 'login']);
});


Route::group(['middleware' => 'auth:sanctum'], function () {

    Route::group(['prefix' => "auth"], function () {
        Route::post('logout', [AuthController::class, 'logout']);
    });

    Route::get('/homecovers', [HomeCoverController::class, 'index']);

    Route::post('/contact-us', [ContactUsController::class, 'store']);
    Route::get('/homecover/{id}', [HomeCoverController::class, 'show']);
    Route::get('/faqs', [FAQController::class, 'index']);
    Route::get('/feedbacks', [FeedBacksController::class, 'index']);
    Route::get('/feedbacks/deleted', [FeedBacksController::class, 'deletedFeedbacks']);
    Route::get('/technologies', [TechnologyController::class, 'index']);
    Route::get('/technologies/deleted', [TechnologyController::class, 'deletedTechnologies']);
    Route::apiResource('packages', PackageController::class);
    Route::apiResource('features', FeatureController::class);
    Route::apiResource('main_needs', MainNeedController::class);
    Route::apiResource('sub_needs', SubNeedsController::class);

    Route::apiResource('about-us', AboutUsController::class)
        ->only(['index', 'update']);


    Route::post('/pay-package', [PaymentController::class, 'payPackage']);

});


