<?php

use App\Http\Controllers\SuperAdmin\{
    AboutUS\AboutUsController,
    Auth\AuthController,
    ContactUs\ContactUsController,
    Domains\TenantController,
    FAQs\FAQController,
    Features\FeatureController,
    FeedBacks\FeedBacksController,
    HomeCovers\HomeCoverController,
    Packages\PackageController,
    PaymentMethods\PaymentMethodController,
    Settings\SettingController,
    Technologies\TechnologyController,
    Users\UserController
};
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

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

        Route::get('/', fn () => redirect()->route('homePage'));

        // Authentication Routes
        Route::get('/home', [HomeController::class, 'index'])->name('homePage');
        Route::get('login', [AuthController::class, 'loginPage'])->name('loginPage');
        Route::post('login', [AuthController::class, 'login'])->name('login');
        Route::get('forget-password', [AuthController::class, 'forgetPasswordPage'])->name('forgetPasswordPage');
        Route::post('forget-password', [AuthController::class, 'forgetPassword'])->name('forgetPassword');
        Route::post('check-code', [AuthController::class, 'checkCode'])->name('checkCode');

        Route::middleware(['auth'])->group(function () {

            // Profile Routes
            Route::get('profile', [AuthController::class, 'profile'])->name('profile_page');
            Route::put('profile-update', [AuthController::class, 'updateProfile'])->name('profile_update');
            Route::post('logout', [AuthController::class, 'logout'])->name('logout');

            // Resource Controllers
            Route::resources([
                'users' => UserController::class,
                'settings' => SettingController::class,
                'features' => FeatureController::class,
                'tenants' => TenantController::class,
                'payment-methods' => PaymentMethodController::class,
                'packages' => PackageController::class,
                'contact-us' => ContactUsController::class,
                'feedbacks' => FeedBacksController::class,
                'technologies' => TechnologyController::class,
                'faqs' => FAQController::class,
            ]);

            // Custom Routes for Users
            Route::prefix('users')->name('users.')->group(function () {
                Route::get('/trashed', [UserController::class, 'trashed'])->name('trashed');
                Route::put('/{id}/restore', [UserController::class, 'restore'])->name('restore');
                Route::delete('/{id}/force-delete', [UserController::class, 'forceDelete'])->name('forceDelete');
            });

            // Payment Methods Additional Routes
            Route::prefix('payment-methods')->name('payments.')->group(function () {
                Route::get('/deleted', [PaymentMethodController::class, 'trashedPaymethod'])->name('trashedPaymethod');
                Route::delete('/{id}/permdelete', [PaymentMethodController::class, 'forceDelete'])->name('permdelete');
                Route::get('/{id}/restore', [PaymentMethodController::class, 'restore'])->name('restore');
            });

            // Package Additional Routes
            Route::prefix('packages')->name('packages.')->group(function () {
                Route::get('archived', [PackageController::class, 'archivedPackages'])->name('archived');
                Route::post('/{id}/restore', [PackageController::class, 'restore'])->name('restore');
                Route::delete('/{id}/force-delete', [PackageController::class, 'forceDelete'])->name('forceDelete');
            });

            // Home Cover Routes
            Route::prefix('homecover')->name('home_cover.')->group(function () {
                Route::get('/{id}', [HomeCoverController::class, 'edit'])->name('edit');
                Route::put('/{id}', [HomeCoverController::class, 'update'])->name('update');
            });

            // Feedbacks Additional Routes
            Route::prefix('feedbacks')->name('feedbacks.')->group(function () {
                Route::get('/deleted', [FeedBacksController::class, 'trashedFeedbacks'])->name('trashedFeedbacks');
                Route::delete('/{id}/permdelete', [FeedBacksController::class, 'forceDelete'])->name('permdelete');
                Route::get('/{feedback}/restore', [FeedBacksController::class, 'restore'])->name('restore');
            });

            // Technologies Additional Routes
            Route::prefix('technologies')->name('technologies.')->group(function () {
                Route::get('/deleted', [TechnologyController::class, 'trashedTechnologies'])->name('trashedTechnologies');
                Route::delete('/{id}/permdelete', [TechnologyController::class, 'forceDelete'])->name('permdelete');
                Route::get('/{technology}/restore', [TechnologyController::class, 'restore'])->name('restore');
            });

            // FAQs Additional Routes
            Route::prefix('faqs')->name('faqs.')->group(function () {
                Route::get('/deleted', [FAQController::class, 'trashedFaqs'])->name('trashedFaqs');
                Route::delete('/{id}/permdelete', [FAQController::class, 'forceDelete'])->name('permdelete');
                Route::get('/{faq}/restore', [FAQController::class, 'restore'])->name('restore');
            });

            // Contact Us Additional Routes
            Route::prefix('contact-us')->name('contact_us.')->group(function () {
                Route::get('/deleted', [ContactUsController::class, 'trashed'])->name('trashed');
                Route::get('/{id}/restore', [ContactUsController::class, 'restore'])->name('restore');
                Route::delete('/{id}/force-delete', [ContactUsController::class, 'forceDelete'])->name('forceDelete');
            });

            // About Us Routes
            Route::prefix('about-us')->name('about_us.')->group(function () {
                Route::get('/{id}/edit', [AboutUsController::class, 'edit'])->name('edit');
                Route::put('/{id}/update', [AboutUsController::class, 'update'])->name('update');
            });

        });

    });
}
