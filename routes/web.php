<?php

use Illuminate\Support\Facades\Route;

// Admin Controllers
use App\Http\Controllers\Admin\AddMechanicController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\InvoiceController as AdminInvoiceController;
use App\Http\Controllers\Admin\UpcomingAppointmentsController;
use App\Http\Controllers\Admin\ScheduleController;
use App\Http\Controllers\Admin\AdminLoginController;
use App\Http\Controllers\Mechanic\UpcomingAppointmentsController;

// Auth Controllers
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\RegisterController;

// Customer Controllers
use App\Http\Controllers\Customer\BookAppointmentController;
use App\Http\Controllers\Customer\CustomerDashboardController;
use App\Http\Controllers\Customer\DiagnosticsController;
use App\Http\Controllers\Customer\CustomerInvoiceController;
use App\Http\Controllers\Customer\CustomerLoginController;
use App\Http\Controllers\Customer\BikeController;
use App\Http\Controllers\Customer\CustomerServiceHistoryController;
use App\Http\Controllers\Customer\CustomerInfoController;

// Mechanic Controllers
use App\Http\Controllers\Mechanic\MechanicLoginController;
use App\Http\Controllers\Mechanic\MechanicDashboardController;
use App\Http\Controllers\Mechanic\MechanicDiagnosticsController;
use App\Http\Controllers\Mechanic\ServiceHistoryController;
use App\Http\Controllers\Mechanic\MechanicTodoController;

// Landing Page
Route::get('/', function () {
    return view('welcome');
})->name('home');

// Static Pages
Route::view('/about', 'about')->name('about');
Route::view('/faq', 'faq')->name('faq');
Route::view('/offerings', 'offerings')->name('offerings');

// Auth Routes
Route::view('/register', 'auth.register')->name('register');
Route::post('/register', [RegisterController::class, 'register'])->name('register.submit');

// Customer Auth
Route::view('/login/customer', 'auth.login_customer')->name('login.customer');
Route::post('/login/customer', [CustomerLoginController::class, 'login'])->name('customer.login.submit');

// Mechanic Auth
Route::view('/login/mechanic', 'auth.login_mechanic')->name('login.mechanic');
Route::post('/login/mechanic', [MechanicLoginController::class, 'login'])->name('mechanic.login.submit');

// Admin Auth
Route::view('/login/admin', 'auth.login_admin')->name('login.admin');
Route::post('/login/admin', [AdminLoginController::class, 'login'])->name('admin.login.submit');

// Admin Routes
Route::get('/admin/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');
Route::get('/admin/add-mechanic', [AddMechanicController::class, 'showForm'])->name('admin.add_mechanic.form');
Route::post('/admin/add-mechanic', [AddMechanicController::class, 'store'])->name('admin.add_mechanic.store');
Route::get('/admin/invoices', [AdminInvoiceController::class, 'index'])->name('admin.invoices');
Route::get('/admin/appointments/upcoming', [UpcomingAppointmentsController::class, 'index'])->name('admin.appointments.upcoming');
Route::get('/admin/schedule/create', [ScheduleController::class, 'showForm'])->name('admin.schedule.form');
Route::post('/admin/schedule/create', [ScheduleController::class, 'store'])->name('admin.schedule.store');

// Customer Routes
Route::get('/customer/dashboard', [CustomerDashboardController::class, 'index'])->name('customer.dashboard');
Route::get('/customer/book-appointment', [BookAppointmentController::class, 'showForm'])->name('customer.book_appointment.form');
Route::post('/customer/book-appointment', [BookAppointmentController::class, 'store'])->name('customer.book_appointment.store');
Route::get('/customer/invoices', [CustomerInvoiceController::class, 'index'])->name('customer.invoices');
Route::get('/customer/diagnostics', [DiagnosticsController::class, 'index'])->name('customer.diagnostics');
Route::get('/customer/my-bike', [BikeController::class, 'showForm'])->name('customer.my_bike');
Route::post('/customer/my-bike', [BikeController::class, 'update'])->name('customer.my_bike.update');
Route::get('/customer/service-history', [CustomerServiceHistoryController::class, 'index'])->name('customer.service_history');
Route::view('/customer/settings', 'customer.settings')->name('customer.settings');
Route::get('/customer/update-info', [CustomerInfoController::class, 'showForm'])->name('customer.update_info');
Route::post('/customer/update-info', [CustomerInfoController::class, 'update'])->name('customer.update_info.submit');

// Mechanic Routes
Route::get('/mechanic/dashboard', [MechanicDashboardController::class, 'index'])->name('mechanic.dashboard');
Route::get('/mechanic/diagnostics', [MechanicDiagnosticsController::class, 'index'])->name('mechanic.diagnostics');
Route::post('/mechanic/diagnostics', [MechanicDiagnosticsController::class, 'store'])->name('mechanic.diagnostics.submit');
Route::get('/mechanic/service-history', [ServiceHistoryController