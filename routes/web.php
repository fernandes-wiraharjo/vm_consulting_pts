<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;

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

Route::middleware('guest')->group(function() {
  Route::get('/', [AuthController::class, 'login'])->name('login');
  Route::post('/login', [AuthController::class, 'doLogin'])->name('do-login');
});

Route::middleware('auth')->group(function() {
  Route::get('/logout', [AuthController::class, 'doLogout'])->name('do-logout');

  Route::get('/home', [HomeController::class, 'index'])->name('home');
});
