<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ReturnsController;
use App\Http\Controllers\UploadController;
use App\Http\Middleware\UserSession;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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


// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [LoginController::class, 'index'])->name('login');
Route::get('/login', [LoginController::class, 'index'])->name('login');


Route::post('/post-login', [LoginController::class, 'post_login'])->name('post-login');

// LOGOUT
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

// Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');



Route::middleware([UserSession::class])->group(function () {



    Route::get('/home', [HomeController::class, 'index'])->name('home');

    Route::get('/returns', [ReturnsController::class, 'index'])->name('returns');
    Route::get('/search-returns', [ReturnsController::class, 'search_by_revision_id'])->name('search-returns');

    Route::get('/upload-returns', [UploadController::class, 'index'])->name('upload-returns');

    Route::get('/uploaded-returns', [UploadController::class, 'uploaded_returns'])->name('uploaded-returns');

    Route::get('/download-return/{filename}', [UploadController::class, 'download_return'])->name('download-return');

    Route::post('/post-upload', [UploadController::class, 'post_upload'])->name('post-upload');


    // Route::get('/', function () {
    //     //
    // });

    // Route::get('/profile', function () {
    //     //
    // })->withoutMiddleware([EnsureTokenIsValid::class]);
});
