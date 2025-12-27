<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\TestController;
use App\Http\Controllers\Admin\QuestionController;
use App\Http\Controllers\Admin\OptionController;

use App\Http\Controllers\FrontController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SubcategoryController;
use App\Http\Controllers\DescriptionPageController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\StateController;
use App\Http\Controllers\EducationJobController;
use App\Http\Controllers\JobBrandController;
use App\Http\Controllers\WebsitePageController;

use App\Http\Controllers\Student\UserLoginController;
use App\Http\Controllers\Student\UserDashboardController;

/*
|--------------------------------------------------------------------------
| STUDENT ROUTES (role = user)
|--------------------------------------------------------------------------
*/

Route::prefix('student')->group(function () {

    // Guest
    Route::get('/login', [UserLoginController::class, 'loginPage'])
        ->name('users.login');

    Route::post('/login-submit', [UserLoginController::class, 'login'])
        ->name('users.login.submit');

    // Protected (ONLY USER)
    Route::middleware(['role:user'])->group(function () {

        Route::get('/dashboard', [UserDashboardController::class, 'index'])
            ->name('users.dashboard');

        Route::get('/logout', [UserLoginController::class, 'logout'])
            ->name('users.logout');

        Route::get('/tests', [UserDashboardController::class, 'index'])
            ->name('student.tests.index');

        Route::get('/test/{test}/start', [UserDashboardController::class, 'startTest'])
            ->name('student.tests.start');

        Route::post('/answer/save', [UserDashboardController::class, 'saveAnswer'])
            ->name('student.answer.save');

        Route::get('/test/{test}/submit', [UserDashboardController::class, 'submit'])
            ->name('student.test.submit');
    });
});


/*
|--------------------------------------------------------------------------
| FRONT ROUTES (Public)
|--------------------------------------------------------------------------
*/
Route::get('/', [FrontController::class, 'home'])->name('home');
Route::get('/contact', [FrontController::class, 'contact'])->name('contact');
Route::get('/jobs', [FrontController::class, 'jobs'])->name('jobs');
Route::get('/category/{slug}', [FrontController::class, 'categoryPages'])->name('category.show');
Route::get('/subcategory/{slug}', [FrontController::class, 'subcategoryPages'])->name('subcategory.show');
Route::get('/view-all/{slug}', [FrontController::class, 'latestUpdates'])->name('latest.updates');
Route::get('/state-wise/{slug}', [FrontController::class, 'stateWiseList']);
Route::get('/page-data/{slug}', [FrontController::class, 'showPage'])->name('page.show');
Route::get('/brand/{slug}', [FrontController::class, 'showBrand']);
Route::get('/education-wise/{slug}', [FrontController::class, 'educationWise']);

// ⚠️ Always LAST (CMS / description page)
Route::get('/{slug}', [FrontController::class, 'descriptionPage'])
    ->name('description.show');


/*
|--------------------------------------------------------------------------
| ADMIN ROUTES (role = admin, saysadmin)
|--------------------------------------------------------------------------
*/
Route::prefix('admin')->group(function () {

    // Guest
    Route::get('/login', [AdminAuthController::class, 'loginPage'])
        ->name('admin.login');

    Route::post('/login-submit', [AdminAuthController::class, 'login'])
        ->name('admin.login.submit');

    // Protected (ADMIN + SYSADMIN)
    Route::middleware(['role:admin,saysadmin'])->group(function () {

        Route::get('/dashboard', [AdminAuthController::class, 'index'])
            ->name('admin.dashboard');

        Route::get('/logout', [AdminAuthController::class, 'logout'])
            ->name('admin.logout');

        Route::resource('categories', CategoryController::class);
        Route::resource('subcategories', SubcategoryController::class);
        Route::resource('description-pages', DescriptionPageController::class);
        Route::resource('users', UserController::class);
        Route::resource('states', StateController::class);
        Route::resource('education-jobs', EducationJobController::class);
        Route::resource('jobbrand', JobBrandController::class);
        Route::resource('website-pages', WebsitePageController::class);
        Route::resource('tests', TestController::class);
        Route::resource('questions', QuestionController::class);
        Route::resource('options', OptionController::class);

        Route::post('/change-status', [AdminController::class, 'changeStatus']);

        Route::get(
            '/get-subcategories/{categoryId}',
            [SubcategoryController::class, 'getByCategory']
        )->name('admin.get-subcategories');
    });
});
