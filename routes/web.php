<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\HomepageController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DepartmentController;
use Illuminate\Support\Facades\Route;

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

Route::group(['middleware' => 'Auth'], function () {
    Route::get('logout', [LoginController::class, 'logout'])->name('logout');

    Route::get('/admin', [HomepageController::class, 'index'])->name('dashboard');

    Route::get('check-in', [HomepageController::class, 'checkIn'])->name('check-in');
    Route::get('check-out', [HomepageController::class, 'checkOut'])->name('check-out');

    Route::group(['prefix' => 'admin/users', 'as' => 'users.'], function () {
        Route::get('/', [UserController::class, 'index'])->name('users');
        Route::get('/store', [UserController::class, 'store'])->name('store');
        Route::post('/save', [UserController::class, 'save'])->name('save');
        Route::get('/edit/{id}', [UserController::class, 'edit'])->name('edit');
        Route::post('/edit/{id}', [UserController::class, 'saveEdit']);
        Route::get('/delete/{id}', [UserController::class, 'delete'])->name('delete');
    });
});

Route::group(['prefix' => 'admin/department', 'as' => 'departments.'], function () {
    Route::get('/', [DepartmentController::class, 'index'])->name('index');
    Route::get('/store', [DepartmentController::class, 'store'])->name('store');
    Route::post('/save', [DepartmentController::class, 'save'])->name('save');
    Route::get('/edit/{id}', [DepartmentController::class, 'edit'])->name('edit');
    Route::post('/edit/{id}', [DepartmentController::class, 'saveEdit']);
    Route::get('/delete/{id}', [DepartmentController::class, 'delete'])->name('delete');
});

Route::get('/', function() {
    return view('welcome');
});

