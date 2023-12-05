<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ClientController;

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
    Route::post('/store', [RoleController::class, 'store'])->name('role::store');
    Route::get('/edit/{roleId}', [RoleController::class, 'edit'])->name('role::edit');
    Route::post('/update/{roleId}', [RoleController::class, 'update'])->name('role::update');
    Route::get('/toggle-activate/{roleId}', [RoleController::class, 'toggleActivate'])->name('role::toggleActivate');
  });

  Route::prefix('user')->group(function() {
    Route::get('/', [UserController::class, 'index'])->name('user::index');
    Route::get('/create', [UserController::class, 'create'])->name('user::create');
    Route::post('/store', [UserController::class, 'store'])->name('user::store');
    Route::get('/edit/{userId}', [UserController::class, 'edit'])->name('user::edit');
    Route::post('/update/{userId}', [UserController::class, 'update'])->name('user::update');
    Route::get('/toggle-activate/{userId}', [UserController::class, 'toggleActivate'])->name('user::toggleActivate');
  });

  Route::prefix('client')->group(function() {
    Route::get('/', [ClientController::class, 'index'])->name('client::index');
    Route::get('/detail/{clientId}', [ClientController::class, 'detail'])->name('client::detail');
    Route::get('/create', [ClientController::class, 'create'])->name('client::create');
    Route::post('/store', [ClientController::class, 'store'])->name('client::store');
    Route::get('/edit/{clientId}', [ClientController::class, 'edit'])->name('client::edit');
    Route::post('/update/{clientId}', [ClientController::class, 'update'])->name('client::update');
    Route::get('/toggle-activate/{clientId}', [ClientController::class, 'toggleActivate'])->name('client::toggleActivate');
  });
});
