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
use App\Http\Controllers\ExamController;

use App\Http\Controllers\Student\UserLoginController;
use App\Http\Controllers\Student\UserDashboardController;

/*
|--------------------------------------------------------------------------
| STUDENT ROUTES (role = user)
|--------------------------------------------------------------------------
*/

Route::prefix('student')->group(function () {

    /* =====================================================
       GUEST ROUTES (LOGIN / REGISTER / LOGIN TO ATTEMPT)
    ===================================================== */
    

        // Login to attempt (store pending attempt)
        Route::get('/login-to-attempt/{test}', [UserLoginController::class, 'loginToAttempt'])
            ->name('student.login.to.attempt');

        // Login
        Route::get('/login', [UserLoginController::class, 'loginPage'])
            ->name('student.login');

        Route::post('/login', [UserLoginController::class, 'login'])
            ->name('student.login.submit');

        // Register
        Route::get('/register', [UserLoginController::class, 'registerPage'])
            ->name('student.register');

        Route::post('/register', [UserLoginController::class, 'register'])
            ->name('student.register.submit');
   


    /* =====================================================
       AUTHENTICATED STUDENT ROUTES
    ===================================================== */
    Route::middleware(['auth', 'user.role'])->group(function () {

        /* Dashboard */
        Route::get('/dashboard', [UserDashboardController::class, 'index'])
            ->name('student.dashboard');

        /* Logout */
        Route::post('/logout', [UserLoginController::class, 'logout'])
        ->name('student.logout');

        /* Exams */
        // Route::get('/exams', [UserDashboardController::class, 'exams'])
        //     ->name('student.exams.index');

        /* Tests by Exam */
        // Route::get('/exams/{slug}/tests', [UserDashboardController::class, 'testsByExam'])
        //     ->name('student.exams.tests');

        /* Start / Continue Test */
        Route::get('/tests/{test}/start', [UserDashboardController::class, 'startTest'])
            ->name('student.tests.start');

        Route::get('/tests/{test}/question', [UserDashboardController::class, 'showQuestion'])
            ->name('student.tests.question');
        Route::get('/my-tests', [UserDashboardController::class, 'myTests'])
            ->name('student.my-tests');
        /* Save Answer */
        Route::post('/tests/answer', [UserDashboardController::class, 'saveAnswer'])
            ->name('student.tests.answer.save');

        /* Submit Test */
        Route::get('/tests/{test}/submit', [UserDashboardController::class, 'submit'])
            ->name('student.tests.submit');

        /* Profile */
        Route::get('/settings', [UserDashboardController::class, 'getSettings'])
            ->name('student.settings');

        Route::post('/settings', [UserDashboardController::class, 'updateSettings'])
            ->name('student.settings.update');
    });

    Route::get('/test/result/{attempt}', [UserDashboardController::class, 'result'])
        ->name('student.tests.result');
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
Route::get('/exams/{slug}', [FrontController::class, 'testsByExam'])
    ->name('front.exams.tests');
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
    Route::middleware(['admin.role:admin,saysadmin'])->group(function () {

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
        Route::resource('exams', ExamController::class);


        Route::post('questions/import', [QuestionController::class, 'import'])->name('questions.import');
        Route::get('/download/sample-questions', function () {
            return response()->download(
                public_path('sample/questions_sample.xlsx')
            );
        })->name('questions.sample.download');
        Route::post('/change-status', [AdminController::class, 'changeStatus']);

        Route::get(
            '/get-subcategories/{categoryId}',
            [SubcategoryController::class, 'getByCategory']
        )->name('admin.get-subcategories');
    });
});
