<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\BranchController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\AuthUserController;


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

Route::get('/', [DashboardController::class, 'index'])->middleware('auth');

Route::get('login', [AuthUserController::class, 'login'])
    ->name('user.login');
Route::post('handleLogin', [AuthUserController::class, 'handleLogin'])
    ->name('user.handleLogin');
Route::get('logout', [AuthUserController::class, 'logout'])
    ->name('user.logout')->middleware('auth');

Route::get('branch', [BranchController::class, 'index'])
    ->name('branch.index')->middleware('auth');
Route::get('branch/create', [BranchController::class, 'create'])
    ->name('branch.create')->middleware('is_superadmin');
Route::post('branch/store', [BranchController::class, 'store'])
    ->name('branch.store')->middleware('is_superadmin');
Route::get('branch/{id}/edit', [BranchController::class, 'edit'])
    ->name('branch.edit')->middleware('is_superadmin');
Route::put('branch/{id}', [BranchController::class, 'update'])
    ->name('branch.update')->middleware('is_superadmin');

Route::get('user/create/{branch_id}/{branch_name}', [UserController::class, 'create'])
    ->name('user.create')->middleware('auth');
Route::post('user/store', [UserController::class, 'store'])
    ->name('user.store')->middleware('is_superadmin');
Route::get('user/{id}/edit', [UserController::class, 'edit'])
    ->name('user.edit')->middleware('is_superadmin');
Route::put('user/{id}', [UserController::class, 'update'])
    ->name('user.update')->middleware('is_superadmin');

Route::get('category', [CategoryController::class, 'index'])
    ->name('category.index')->middleware('auth');
Route::get('category/create', [CategoryController::class, 'create'])
    ->name('category.create')->middleware('is_superadmin');
Route::post('category/store', [CategoryController::class, 'store'])
    ->name('category.store')->middleware('is_superadmin');
Route::get('category/{id}/edit', [CategoryController::class, 'edit'])
    ->name('category.edit')->middleware('is_superadmin');
Route::put('category/{id}', [CategoryController::class, 'update'])
    ->name('category.update')->middleware('is_superadmin');
