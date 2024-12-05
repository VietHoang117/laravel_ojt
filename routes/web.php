<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\HomepageController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\PayrollController;
use App\Http\Controllers\SalaryLevelController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\JustificationController;
use App\Http\Controllers\ConfigurationController;
use App\Http\Controllers\LeaveRequestController;
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

    Route::get('/admin', [HomepageController::class, 'index'])->name('dashboard')->middleware('permission:view_dashboard');
    Route::get('/admin/edit', [HomepageController::class, 'edit'])->name('edit')->middleware('permission:view_edit');

    Route::get('/admin/search', [HomepageController::class, 'index'])->name('search');


    Route::get('check-in', [HomepageController::class, 'checkIn'])->name('check-in')->middleware('permission:check_in');
    Route::get('check-out', [HomepageController::class, 'checkOut'])->name('check-out')->middleware('permission:check_out');

    Route::group(['middleware' => ['permission:view_user|create_user|edit_user|delete_user']], function () {
        Route::group(['prefix' => 'admin/users', 'as' => 'users.'], function () {
            Route::get('/', [UserController::class, 'index'])->name('users');
            Route::get('/store', [UserController::class, 'store'])->name('store');
            Route::post('/save', [UserController::class, 'save'])->name('save');
            Route::get('/edit/{id}', [UserController::class, 'edit'])->name('edit');
            Route::post('/edit/{id}', [UserController::class, 'saveEdit']);
            Route::get('/delete/{id}', [UserController::class, 'delete'])->name('delete');
        });
        Route::post('/import-users', [UserController::class, 'importUsers'])->name('import.users');
        Route::get('/export-users', [UserController::class, 'exportUsers'])->name('export.users');
    });

    Route::group(['middleware' => ['permission:view_department|create_department|edit_department|delete_department']], function () {
        Route::group(['prefix' => 'admin/department', 'as' => 'departments.'], function () {
            Route::get('/', [DepartmentController::class, 'index'])->name('index');
            Route::get('/store', [DepartmentController::class, 'store'])->name('store');
            Route::post('/save', [DepartmentController::class, 'save'])->name('save');
            Route::get('/edit/{id}', [DepartmentController::class, 'edit'])->name('edit');
            Route::post('/edit/{id}', [DepartmentController::class, 'saveEdit']);
            Route::get('/delete/{id}', [DepartmentController::class, 'delete'])->name('delete');
        });
    });

    Route::group(['middleware' => ['permission:view_payroll|create_payroll|edit_payroll|delete_payroll']], function () {
        Route::group(['prefix' => 'admin/payroll', 'as' => 'payrolls.'], function () {
            Route::get('/', [PayrollController::class, 'index'])->name('index');
            Route::get('/store', [PayrollController::class, 'store'])->name('store');
            Route::post('/save', [PayrollController::class, 'save'])->name('save');
            Route::get('/edit/{id}', [PayrollController::class, 'edit'])->name('edit');
            Route::post('/edit/{id}', [PayrollController::class, 'saveEdit']);
            Route::get('/delete/{id}', [PayrollController::class, 'delete'])->name('delete');
        });
    });

    Route::get('admin/payroll/update-wage', [PayrollController::class, 'updateWage'])->name('payrolls.update-wage')->middleware('permission:update_payroll');

    Route::group(['middleware' => ['permission:view_salarylevels|create_salarylevels|edit_salarylevels|delete_salarylevels']], function () {
        Route::group(['prefix' => 'admin/salary-level', 'as' => 'salarylevels.'], function () {
            Route::get('/', [SalaryLevelController::class, 'index'])->name('index');
            Route::get('/store', [SalaryLevelController::class, 'create'])->name('store');
            Route::post('/save', [SalaryLevelController::class, 'save'])->name('save');
            Route::get('/edit/{id}', [SalaryLevelController::class, 'edit'])->name('edit');
            Route::post('/edit/{id}', [SalaryLevelController::class, 'saveEdit'])->name('save.edit');
            Route::get('/delete/{id}', [SalaryLevelController::class, 'delete'])->name('delete');
        });
        Route::get('/export-payrolls', [PayrollController::class, 'exportPayrolls'])->name('export.payrolls');
    });

    Route::get('/api/salary-level/{id}', [SalaryLevelController::class, 'getSalaryLevel'])->name('api.salary-level');
    
    Route::group(['middleware' => ['permission:view_justifications|create_justifications|edit_justifications|delete_justifications']], function () {
        Route::group(['prefix' => 'admin/justification', 'as' => 'justifications.'], function () {
            Route::get('/', [JustificationController::class, 'index'])->name('index');
            Route::get('/store', [JustificationController::class, 'create'])->name('store');
            Route::post('/save', [JustificationController::class, 'save'])->name('save');
            Route::get('/edit/{id}', [JustificationController::class, 'edit'])->name('edit');
            Route::post('/edit/{id}', [JustificationController::class, 'saveEdit'])->name('save.edit');
            Route::get('/delete/{id}', [JustificationController::class, 'delete'])->name('delete');
            Route::post('/submit/{id}', [JustificationController::class, 'submit'])->name('submit');
            Route::post('/report/{id}', [JustificationController::class, 'reportJustification'])->name('report');
        });
        Route::get('/export-payrolls', [PayrollController::class, 'exportPayrolls'])->name('export.payrolls');
    });

    Route::group(['middleware' => ['permission:view_configurations|create_configurations|edit_configurations|delete_configurations']], function () {
        Route::group(['prefix' => 'configuration', 'as' => 'configurations.'], function () {
            Route::get('/', [ConfigurationController::class, 'index'])->name('index');
            Route::get('/store', [ConfigurationController::class, 'create'])->name('store');
            Route::post('/save', [ConfigurationController::class, 'save'])->name('save');
            // Route::get('/edit/{id}', [ConfigurationController::class, 'edit'])->name('edit');
            // Route::post('/edit/{id}', [ConfigurationController::class, 'saveEdit'])->name('save.edit');
            // Route::get('/delete/{id}', [ConfigurationController::class, 'delete'])->name('delete');
            Route::post('/submit/{id}', [ConfigurationController::class, 'submit'])->name('submit');
        });
        
    });

    Route::get('/attendance/{id}/edit', [HomepageController::class, 'edit'])->name(name: 'attendance.edit');
    Route::put('/attendance/{id}', [HomepageController::class, 'update'])->name('attendance.update');


    // đề xuất nghỉ phép
    Route::group(['middleware' => ['permission:view_leaves|create_leaves|edit_leaves|delete_leaves']], function () {
        Route::group(['prefix' => 'admin/leaves', 'as' => 'leaves.'], function () {
            Route::get('/', [LeaveRequestController::class, 'index'])->name('index');            
            Route::post('/save', [LeaveRequestController::class, 'save'])->name('save');
            Route::post('/approval/{id}', [LeaveRequestController::class, 'approval'])->name('approval');
            Route::post('/browse/{id}', [LeaveRequestController::class, 'browse'])->name('browse');
            
            Route::get('/edit/{id}', [LeaveRequestController::class, 'edit'])->name('edit');
            Route::post('/edit/{id}', [LeaveRequestController::class, 'saveEdit'])->name('save.edit');
            Route::get('/delete/{id}', [LeaveRequestController::class, 'delete'])->name('delete');
        });
        Route::get('/export-payrolls', [PayrollController::class, 'exportPayrolls'])->name('export.payrolls');
    });




});


Route::get('/', function () {
    return view('welcome');
});

Route::get("/view", [UserController::class, "view"]);
Route::get("/export", [UserController::class, "export"]);


Route::get('/b', function () {
    dd(env('APP_URL'));
});


