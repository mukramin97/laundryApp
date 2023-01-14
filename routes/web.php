<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\BranchController;
use App\Http\Controllers\EmployeeController;

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

Route::get('/', [DashboardController::class, 'index']);
Route::get('/about', [DashboardController::class, 'about']);

Route::get('branch', [BranchController::class, 'index'])
    ->name('branch.index');
Route::get('branch/{id}/edit', [BranchController::class, 'edit'])
    ->name('branch.edit');
Route::get('branch/create', [BranchController::class, 'create'])
    ->name('branch.create');
Route::post('branch/store', [BranchController::class, 'store'])
    ->name('branch.store');
Route::put('branch/{id}', [BranchController::class, 'update'])
    ->name('branch.update');

Route::get('employee/create/{branch_id}/{branch_name}', [EmployeeController::class, 'create'])
    ->name('employee.create');
Route::post('employee/store', [EmployeeController::class, 'store'])
    ->name('employee.store');