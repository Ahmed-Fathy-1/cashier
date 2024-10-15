<?php

<<<<<<< HEAD
use App\Http\Controllers\SuperAdmin\AboutUS\AboutUsController;
=======
use App\Http\Controllers\SuperAdmin\FAQs\FAQController;
use App\Http\Controllers\SuperAdmin\FeedBacks\FeedBacksController;
use App\Http\Controllers\SuperAdmin\Technologies\TechnologyController;
>>>>>>> f96dd2dedd6e5dde12888da8318888d2f556e7f1
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SuperAdmin\Auth\AuthController;
use App\Http\Controllers\SuperAdmin\Users\UserController;
use App\Http\Controllers\SuperAdmin\Domains\TenantController;
use App\Http\Controllers\SuperAdmin\Packages\PackageController;
use App\Http\Controllers\SuperAdmin\Settings\SettingController;
use App\Http\Controllers\SuperAdmin\PaymentMethods\PaymentMethodController;
use App\Http\Controllers\SuperAdmin\ContactUs\ContactUsController;

use App\Http\Controllers\SuperAdmin\HomeCovers\HomeCoverController;
use App\Http\Controllers\SuperAdmin\FAQs\FAQAPIController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

foreach (config('tenancy.central_domains') as $domain) {
    Route::domain($domain)->group(function () {
        // your actual routes

        // Route::get('/', function () {
        //     return view('welcome');
        // });


        Route::get('/', function () {
            return redirect()->route('homePage');
        });

        Route::get('/home', [HomeController::class, 'index'])->name('homePage');

        Route::get('login', [AuthController::class, "loginPage"])->name('loginPage');
        Route::post('login', [AuthController::class, "login"])->name('login');
        Route::get('forget-password', [AuthController::class, "forgetPasswordPage"])->name('forgetPasswordPage');
        Route::post('forget-password', [AuthController::class, "forgetPassword"])->name('forgetPassword');
        Route::post('check-code', [AuthController::class, "checkCode"])->name('checkCode');

        Route::group(['middleware' => ['auth']], function () {

            Route::get('profile', [AuthController::class, 'profile'])->name('profile_page');
            Route::put('profile-update', [AuthController::class, 'updateProfile'])->name('profile_update');
            Route::post('logout', [AuthController::class, 'logout'])->name('logout');

            // users
            Route::resource('users', UserController::class);

            // Roles
            // Route::resource('roles', RoleController::class);

            // settings
            Route::resource('settings', SettingController::class);

<<<<<<< HEAD
                // About Us
                // Route::get('about-us/edit/{id}', [AboutUsController::class, 'edit'])->name('about-us.edit');
                // Route::post('about-us/update/{id}', [AboutUsController::class, 'update'])->name('about-us.update');
                // Route::put('about-us/update/{id}', [AboutUsController::class, 'update'])->name('about-us.update');
                Route::get('/about-us/{id}/edit', [AboutUsController::class, 'edit'])->name('about_us.edit');
//                Route::put('/about-us/{id}', [AboutUsController::class, 'update'])->name('about_us.update');
                Route::put('/about-us/{id}/update',[AboutUsController::class, 'update'])->name('about_us.update');

                // tenants
                Route::resource('tenants', TenantController::class);
=======
            // tenants
            Route::resource('tenants', TenantController::class);

            // payment methods
            Route::resource('payment-methods', PaymentMethodController::class);

            // packages
            Route::resource('packages', PackageController::class);

            // Home Cover
            Route::get('homecover/{id}', [HomeCoverController::class, 'edit'])->name('home_cover');
            Route::put('homecover/{id}', [HomeCoverController::class, 'update'])->name('update_home_cover');

            // Feedbacks
            Route::delete('/feedbacks/{id}/permdelete', [FeedBacksController::class, 'forceDelete'])->name('feedbacks.permdelete');
            Route::get('/feedbacks/deleted', [FeedBacksController::class, 'trashedFeedbacks'])->name('feedbacks.trashedFeedbacks');
            Route::put('/feedbacks/{feedback}/restore', [FeedBacksController::class, 'restore'])->name('feedbacks.restore');
            Route::resource('feedbacks', FeedBacksController::class);

            // Technologies
            Route::delete('/technologies/{id}/permdelete', [TechnologyController::class, 'forceDelete'])->name('technologies.permdelete');
            Route::get('/technologies/deleted', [TechnologyController::class, 'trashedTechnologies'])->name('technologies.trashedTechnologies');
            Route::put('/technologies/{technology}/restore', [TechnologyController::class, 'restore'])->name('technologies.restore');
            Route::resource('technologies', TechnologyController::class);

            // FAQs
            Route::delete('/faqs/{id}/permdelete', [FAQController::class, 'forceDelete'])->name('faqs.permdelete');
            Route::get('/faqs/deleted', [FAQController::class, 'trashedFaqs'])->name('faqs.trashedFaqs');
            Route::put('/faqs/{faq}/restore', [FAQController::class, 'restore'])->name('faqs.restore');
            Route::resource('faqs', FAQController::class);
>>>>>>> f96dd2dedd6e5dde12888da8318888d2f556e7f1


                // packages
                Route::resource('packages', PackageController::class);

<<<<<<< HEAD
=======

                // contact us
                Route::resource('contact-us', ContactUsController::class);
                Route::post('/contact-us', [ContactUsController::class, 'store'])->name('contact_us.store');




>>>>>>> f96dd2dedd6e5dde12888da8318888d2f556e7f1
            });




    });
}



