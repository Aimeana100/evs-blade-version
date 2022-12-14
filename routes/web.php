<?php

use Carbon\Carbon;
use Inertia\Inertia;
use App\Models\Admin\Vistor;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\admin\ReportController;
use App\Http\Controllers\Admin\VistorController;
use App\Http\Controllers\Admin\CompanyController;
use App\Http\Controllers\Admin\EmployeeController;
use App\Http\Controllers\API\GateKeeperController;

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

// Report

Route::get('/report', [ReportController::class, 'index']);

// admin
Route::get('/', function(){
    return view('welcome');
})->name('home');


Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->middleware(['auth', 'verified'])->name('dashboard');

// users

Route::get('/user', [UserController::class, 'users'])->middleware(['auth', 'verified'])->name('users');
Route::get('/user/create', [UserController::class, 'create'])->middleware(['auth', 'verified'])->name('users.create');
Route::get('/user/edit/{id}', [UserController::class, 'edit'])->middleware(['auth', 'verified'])->name('users.edit');

// visitor
Route::get('/vistors', [VistorController::class, 'vistors'])->middleware(['auth', 'verified'])->name('admin.visitors');

// companies
Route::get('/companies', [CompanyController::class, 'companies'])->middleware(['auth', 'verified'])->name('companies');
Route::post('/companies/store', [CompanyController::class, 'store'])->middleware(['auth', 'verified'])->name('companies.store');
Route::get('/companies/burn/{company}', [CompanyController::class, 'companyBurn'])->middleware(['auth', 'verified'])->name('company.burn');

Route::get('/employees', [EmployeeController::class, 'employees'])->middleware(['auth', 'verified'])->name('admin.employees');
Route::get('/employees/Attendance', [EmployeeController::class, 'employeesAttendance'])->middleware(['auth', 'verified'])->name('admin.attendance');
Route::get('/employees/Attendance/{category}', [EmployeeController::class, 'employeesAttendanceCategory'])->middleware(['auth', 'verified'])->name('admin.attendance.category');
Route::get('/employees/Attendance/download', [EmployeeController::class, 'employeesAttendanceDownload'])->middleware(['auth', 'verified'])->name('admin.attendance.download');
Route::get('/employees/burn/{employee}', [EmployeeController::class, 'employeeBurn'])->middleware(['auth', 'verified'])->name('employee.burn');
Route::get('/employees/attendance/{id}', [EmployeeController::class, 'employeeAttendanceOne'])->middleware(['auth', 'verified'])->name('employee.attendance.one');
Route::post('/employees/upload', [EmployeeController::class, 'uploadEmployees'])->middleware(['auth', 'verified'])->name('employee.upload');
Route::post('/employees/update', [EmployeeController::class, 'updateEmployee'])->middleware(['auth', 'verified'])->name('employee.update');


Route::get('/users', [UserController::class, 'users'])->middleware(['auth', 'verified'])->name('admin.users');
Route::post('/users/create', [UserController::class, 'create'])->middleware(['auth', 'verified'])->name('admin.users.create');
Route::get('/logs', [UserController::class, 'logs'])->middleware(['auth', 'verified'])->name('admin.logs');

Route::post('/users/gate/create', [GateKeeperController::class, 'create'])->middleware(['auth', 'verified'])->name('admin.security.create');



Route::get('/equipments', [AdminController::class, 'equipments'])->middleware(['auth', 'verified'])->name('equipments');
Route::get('/account', [AdminController::class, 'account'])->middleware(['auth', 'verified'])->name('admin.account');
Route::post('/account/update', [AdminController::class, 'accountUpdate'])->middleware(['auth', 'verified'])->name('admin.update.acount');

Route::get('/editPassword', [AdminController::class, 'editPassword'])->middleware(['auth', 'verified'])->name('admin.editPassword');
Route::post('/editPassword', [AdminController::class, 'updatePassword'])->middleware(['auth', 'verified'])->name('admin.update.password');

// Route::get('/visitors', [EmployeeController::class, 'visitors'])->middleware(['auth', 'verified'])->name('admin.visitors');


Route::get('/alcoholTest', [EmployeeController::class, 'alcoholTest'])->middleware(['auth', 'verified'])->name('admin.alcohol_test');


require __DIR__ . '/auth.php';
