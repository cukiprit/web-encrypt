<?php

use App\Http\Controllers\Auth\LoginController as AuthLoginController;
use App\Http\Controllers\Auth\LogoutController as AuthLogoutController;
use App\Http\Controllers\Auth\RegisterController as AuthRegisterController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FileEncryptionController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\RegisterController;

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

Route::namespace('App\Http\Controllers')->group(function () {
  Route::group(['middleware' => ['auth']], function () {
    Route::get('/', [FileEncryptionController::class, 'viewencrypt'])->name('dashboard');
    Route::get('/decrypt', [FileEncryptionController::class, 'decrypt'])->name('decrypt');
    Route::get('/encrypt', [FileEncryptionController::class, 'encrypt'])->name('encrypt');
    Route::post('/file', [FileEncryptionController::class, 'store'])->name('store');
    Route::post('/files/download/{id}', [FileEncryptionController::class, 'download'])->name('download');
    Route::get('/logout', [AuthLogoutController::class, 'logout'])->name('logout');
  });

  Route::namespace('Auth')->group(function () {
    Route::get('/register', [AuthRegisterController::class, 'index'])->name('register');
    Route::post('/register', [AuthRegisterController::class, 'register']);

    Route::get('/login', [AuthLoginController::class, 'index'])->name('login');
    Route::post('/login', [AuthLoginController::class, 'login']);
  });
});
