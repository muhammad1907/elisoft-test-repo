<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/



// Soal no 1
// Route::middleware([VerifyCsrfToken::class])->post('/register-ok', 'App\Http\Controllers\SoalController@register')->withoutMiddleware([VerifyCsrfToken::class]);

// Route::middleware([VerifyCsrfToken::class])->post('/soalNo4', 'App\Http\Controllers\SoalController@soalNo4')->withoutMiddleware([VerifyCsrfToken::class]);
Route::get('/soalNo5', 'App\Http\Controllers\UserController@getUsers');
Route::get('/soalNo6', 'App\Http\Controllers\SoalController@soalNo6');
Route::get('/soalNo7', 'App\Http\Controllers\SoalController@soalNo7');


Route::middleware(['auth'])->group(function () {
    

    Route::get('/email/verify', function () {
        return view('auth.verify');
    })->name('verification.notice');

    Route::get('/email/verify/{id}/{hash}', function (Request $request, EmailVerificationRequest $emailVerificationRequest) {
        $emailVerificationRequest->fulfill();
        return redirect('/dashboard')->with('success', 'Your email has been verified.');
    })->middleware(['signed'])->name('verification.verify');
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    Route::get('/user-create', [App\Http\Controllers\UserController::class, 'getUser'])->name('user-create');
    Route::get('/user-all', [App\Http\Controllers\UserController::class, 'getUsersAll'])->name('user-all');
    Route::post('/user-process', [App\Http\Controllers\UserController::class, 'createUser'])->name('user-process');
    Route::get('/users/{id}/edit', [App\Http\Controllers\UserController::class, 'editUser'])->name('users.edit');
    Route::get('/users/{id}/read', [App\Http\Controllers\UserController::class, 'readUser'])->name('users.read');
    Route::PATCH('/user-update/{id}', 'App\Http\Controllers\UserController@updateUser')->name('user-update');

    Route::delete('/users/{id}', 'App\Http\Controllers\UserController@deleteUser')->name('user-delete');

    Route::post('/soalNo4', 'App\Http\Controllers\SoalController@soalNo4')->name('soalNo4');
    Route::get('/view-soal', 'App\Http\Controllers\SoalController@viewSoalNo4')->name('view-soal');
});



// Auth::routes();
Route::get('/register', 'App\Http\Controllers\Auth\RegisterController@showRegistrationForm')->name('register');
Route::post('/register', 'App\Http\Controllers\Auth\RegisterController@register')->name('register-process');
Route::get('/', [App\Http\Controllers\Auth\LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [App\Http\Controllers\Auth\LoginController::class, 'login'])->name('login-process');
Route::get('/logout', [App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('logout');


