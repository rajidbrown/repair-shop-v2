<?php

use Illuminate\Support\Facades\Route;

// ---------------------
// Admin Controllers
// ---------------------
use App\Http\Controllers\Admin\AddMechanicController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\InvoiceController as AdminInvoiceController;
use App\Http\Controllers\Admin\CreateScheduleController;
use App\Http\Controllers\Admin\UpcomingAppointmentsController as AdminUpcomingAppointmentsController;
use App\Http\Controllers\Admin\ViewCustomersController;

// ---------------------
// Auth Controllers
// ---------------------
use App\Http\Controllers\Auth\AdminLoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\MechanicLoginController;
use App\Http\Controllers\Auth\CustomerLoginController;
use App\Http\Controllers\Auth\RegisterCustomerController;

// ---------------------
// Customer Controllers
// ---------------------
use App\Http\Controllers\Customer\BookAppointmentController;
use App\Http\Controllers\Customer\CustomerDashboardController;
use App\Http\Controllers\Customer\CustomerDiagnosticsController;
use App\Http\Controllers\Customer\CustomerInvoiceController;
use App\Http\Controllers\Customer\BikeController;
use App\Http\Controllers\Customer\CustomerServiceHistoryController;
use App\Http\Controllers\Customer\CustomerInfoController;
use App\Http\Controllers\Customer\CustomerAppointmentController;

// ---------------------
// Mechanic Controllers
// ---------------------
use App\Http\Controllers\Mechanic\MechanicDashboardController;
use App\Http\Controllers\Mechanic\MechanicDiagnosticsController;
use App\Http\Controllers\Mechanic\ServiceHistoryController;
use App\Http\Controllers\Mechanic\MechanicTodoController;
use App\Http\Controllers\Mechanic\MechanicInfoController;
use App\Http\Controllers\Mechanic\UpcomingAppointmentsController as MechanicUpcomingAppointmentsController;
use App\Http\Controllers\Mechanic\TodayAppointmentsController;
use App\Http\Controllers\Mechanic\MechanicCustomersController;

// ---------------------
// Static Pages
// ---------------------
Route::view('/', 'welcome')->name('home');
Route::view('/about', 'about')->name('about');
Route::view('/faq', 'faq')->name('faq');
Route::view('/offerings', 'offerings')->name('offerings');

// ---------------------
// Auth Routes
// ---------------------

// Customer Registration
Route::get('/register', [RegisterCustomerController::class, 'showForm'])->name('register');
Route::post('/register', [RegisterCustomerController::class, 'register'])->name('register.submit');

// Customer Login
Route::get('/login/customer', [CustomerLoginController::class, 'showLoginForm'])->name('login.customer');
Route::post('/login/customer', [CustomerLoginController::class, 'login'])->name('customer.login.submit');

// Mechanic Login
Route::view('/login/mechanic', 'auth.login_mechanic')->name('login.mechanic');
Route::post('/login/mechanic', [MechanicLoginController::class, 'login'])->name('mechanic.login.submit');

// Admin Login
Route::view('/login/admin', 'auth.login_admin')->name('login.admin');
Route::post('/login/admin', [AdminLoginController::class, 'login'])->name('admin.login.submit');

// Shared Logout
Route::post('/logout', [LogoutController::class, 'logout'])->name('logout');

// ---------------------
// Admin Routes
// ---------------------
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
    Route::view('/settings', 'admin.settings')->name('settings');

    // Mechanics
    Route::get('/add-mechanic', [AddMechanicController::class, 'showForm'])->name('add_mechanic.form');
    Route::post('/add-mechanic', [AddMechanicController::class, 'store'])->name('add_mechanic.store');
    Route::get('/mechanics/{id}/edit', [AddMechanicController::class, 'edit'])->name('mechanics.edit');
    Route::put('/mechanics/{id}', [AddMechanicController::class, 'update'])->name('mechanics.update');

    // Schedule Management
    Route::get('/schedule/create', [CreateScheduleController::class, 'showForm'])->name('schedule.create');
    Route::post('/schedule/create', [CreateScheduleController::class, 'store'])->name('schedule.store');
    Route::get('/schedule/edit', [CreateScheduleController::class, 'editAll'])->name('schedule.edit');
    Route::put('/schedule/update', [CreateScheduleController::class, 'updateAll'])->name('schedule.update');
    Route::get('/mechanics/{id}/schedule', [CreateScheduleController::class, 'editForMechanic'])->name('mechanics.schedule.edit');
    Route::put('/mechanics/{id}/schedule', [CreateScheduleController::class, 'updateForMechanic'])->name('mechanics.schedule.update');

    // Appointments & Invoices
    Route::get('/appointments/upcoming', [AdminUpcomingAppointmentsController::class, 'index'])->name('appointments.upcoming');
    Route::get('/invoices', [AdminInvoiceController::class, 'index'])->name('invoices');

    // Customers
    Route::get('/customers', [ViewCustomersController::class, 'index'])->name('customers');
});

// ---------------------
// Customer Routes
// ---------------------
Route::prefix('customer')->name('customer.')->group(function () {
    Route::get('/dashboard', [CustomerDashboardController::class, 'index'])->name('dashboard');

    Route::get('/book-appointment', [BookAppointmentController::class, 'showForm'])->name('appointment.form');
    Route::post('/book-appointment', [BookAppointmentController::class, 'store'])->name('appointment.book');

    Route::get('/invoices', [CustomerInvoiceController::class, 'index'])->name('invoices');
    Route::get('/diagnostics', [CustomerDiagnosticsController::class, 'index'])->name('diagnostics');

    Route::get('/my-bike', [BikeController::class, 'showForm'])->name('bike');
    Route::post('/my-bike', [BikeController::class, 'update'])->name('my_bike.update');

    Route::get('/service-history', [CustomerServiceHistoryController::class, 'index'])->name('service_history');
    Route::view('/settings', 'customer.settings')->name('settings');

    Route::get('/update-info', [CustomerInfoController::class, 'showForm'])->name('update_info');
    Route::post('/update-info', [CustomerInfoController::class, 'update'])->name('update_info.submit');

    Route::get('/appointments', [CustomerAppointmentController::class, 'index'])->name('appointments');
    Route::delete('/appointments/{id}', [CustomerAppointmentController::class, 'destroy'])->name('appointments.destroy');
});

// ---------------------
// Mechanic Routes
// ---------------------
Route::prefix('mechanic')->name('mechanic.')->group(function () {
    Route::get('/dashboard', [MechanicDashboardController::class, 'index'])->name('dashboard');

    Route::get('/diagnostics', [MechanicDiagnosticsController::class, 'index'])->name('diagnostics');
    Route::post('/diagnostics', [MechanicDiagnosticsController::class, 'store'])->name('diagnostics.submit');

    Route::get('/service-history', [ServiceHistoryController::class, 'index'])->name('service_history');
    Route::get('/todo', [MechanicTodoController::class, 'index'])->name('todo');
    Route::post('/todo/update', [MechanicTodoController::class, 'update'])->name('todo.update');

    Route::get('/upcoming-appointments', [MechanicUpcomingAppointmentsController::class, 'index'])->name('upcoming_appointments');
    Route::get('/appointments/today', [TodayAppointmentsController::class, 'index'])->name('appointments.today');

    Route::get('/update-info', [MechanicInfoController::class, 'showForm'])->name('info');
    Route::post('/update-info', [MechanicInfoController::class, 'update'])->name('info.update');

    Route::get('/customers', [MechanicCustomersController::class, 'index'])->name('customers');
});