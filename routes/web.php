<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RoleController;

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

  Route::prefix('role')->group(function() {
    Route::get('/', [RoleController::class, 'index'])->name('role::index');
    Route::get('/create', [RoleController::class, 'create'])->name('role::create');
    Route::post('/create', [RoleController::class, 'store'])->name('role::store');
    Route::get('/edit/{roleId}', [RoleController::class, 'edit'])->name('role::edit');
    Route::post('/update/{roleId}', [RoleController::class, 'update'])->name('role::update');
    Route::get('/toggle-activate/{roleId}', [RoleController::class, 'toggleActivate'])->name('role::toggleActivate');
  });
});
