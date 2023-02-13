<?php

use App\Http\Controllers\UserController;
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

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\UserController::class, 'index'])->name('home');

Route::group(['middleware' => 'auth'], function () {

    Route::prefix('user')->group(function () {
        Route::get('/list', [UserController::class, 'get'])->name('user-list');
        Route::post('/save', [UserController::class, 'save'])->name('user-save');
        Route::get('/find/{id}', [UserController::class, 'find'])->name('user-find');
        Route::get('/delete/{id}', [UserController::class, 'delete'])->name('user-delete');
    });
});
