<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\HomepageController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DepartmentController;
use Illuminate\Support\Facades\Route;
use App\Mail\ExampleEmail;
use Illuminate\Support\Facades\Mail;
use MailerSend\Helpers\Builder\Recipient;
use MailerSend\Helpers\Builder\EmailParams;
use MailerSend\MailerSend;
use Illuminate\Support\Facades\Http;
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
});


Route::get('/', function () {
    return view('welcome');
});

Route::get("/view", [UserController::class, "view"]);
Route::get("/export", [UserController::class, "export"]);


Route::get('/send-example-mail', function () {
    $response = Http::withHeaders([
        'Content-Type' => 'application/json',
        'X-Requested-With' => 'XMLHttpRequest',
        'Authorization' => 'Bearer mlsn.e827df1ce34e07cd5dc804fdb37231342ed232fc14ce535e01117410c2a64dc3', // Thay {your-token-here} bằng token thực tế
    ])->post('https://api.mailersend.com/v1/email', [
        'from' => [
            'email' => 'smtp.mailersend.net',
        ],
        'to' => [
            [
                'email' => 'truongviethoang64@gmail.com',
            ],
        ],
        'subject' => 'Hello from MailerSend!',
        'text' => 'Greetings from the team, you got this message through MailerSend.',
        'html' => 'Greetings from the team, you got this message through MailerSend.',
    ]);
    
    // Kiểm tra kết quả phản hồi
    if ($response->successful()) {
        // Thành công
        return 'Email sent successfully!';
    } else {
        // Xử lý lỗi
        return $response->body();
    }
});
