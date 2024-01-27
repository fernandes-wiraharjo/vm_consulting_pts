<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\PositionController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\ProjectTrackingController;
use App\Http\Controllers\DailyTaskController;

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

  Route::prefix('position')->group(function() {
    Route::get('/', [PositionController::class, 'index'])->name('position::index');
    Route::get('/create', [PositionController::class, 'create'])->name('position::create');
    Route::post('/store', [PositionController::class, 'store'])->name('position::store');
    Route::get('/edit/{positionId}', [PositionController::class, 'edit'])->name('position::edit');
    Route::post('/update/{positionId}', [PositionController::class, 'update'])->name('position::update');
    Route::get('/toggle-activate/{positionId}', [PositionController::class, 'toggleActivate'])->name('position::toggleActivate');
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

  Route::prefix('project-tracking')->group(function() {
    Route::get('/', [ProjectTrackingController::class, 'index'])->name('project-tracking::index');
    Route::get('/create', [ProjectTrackingController::class, 'create'])->name('project-tracking::create');
    Route::post('/store', [ProjectTrackingController::class, 'store'])->name('project-tracking::store');
    Route::get('/edit/{jobId}', [ProjectTrackingController::class, 'edit'])->name('project-tracking::edit');
    Route::post('/update/{jobId}', [ProjectTrackingController::class, 'update'])->name('project-tracking::update');
    Route::get('/detail-job/{jobId}', [ProjectTrackingController::class, 'detailPerJob'])->name('project-tracking::detailPerJob');
    Route::get('/detail-user/{jobId}/{userId}', [ProjectTrackingController::class, 'detailPerUser'])->name('project-tracking::detailPerUser');
    Route::get('/detail-user/edit/{jobId}/{userId}/{jobDetailId}', [ProjectTrackingController::class, 'editDetailPerUser'])->name('project-tracking::editDetailPerUser');
    Route::post('/detail-user/update/{jobId}/{userId}/{jobDetailId}', [ProjectTrackingController::class, 'updateDetailPerUser'])->name('project-tracking::updateDetailPerUser');
    Route::get('/toggle-activate/{jobId}', [ProjectTrackingController::class, 'toggleActivate'])->name('project-tracking::toggleActivate');
  });

  Route::prefix('daily-task')->group(function() {
    Route::get('/', [DailyTaskController::class, 'index'])->name('daily-task::index');
    Route::get('/create', [DailyTaskController::class, 'create'])->name('daily-task::create');
    Route::post('/store', [DailyTaskController::class, 'store'])->name('daily-task::store');
    Route::get('/detail/{date}/{userId}', [DailyTaskController::class, 'detail'])->name('daily-task::detail');
    Route::get('/edit/{jobDetailId}', [DailyTaskController::class, 'edit'])->name('daily-task::edit');
    Route::post('/update/{jobDetailId}', [DailyTaskController::class, 'update'])->name('daily-task::update');
    Route::get('/delete/{jobDetailId}', [DailyTaskController::class, 'delete'])->name('daily-task::delete');
  });
});
