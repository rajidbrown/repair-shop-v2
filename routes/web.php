<?php

use Illuminate\Support\Facades\Route;

// ---------------------
// Controllers
// ---------------------

// Admin
use App\Http\Controllers\Admin\AddMechanicController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\InvoiceController as AdminInvoiceController;
use App\Http\Controllers\Admin\CreateScheduleController;
use App\Http\Controllers\Admin\UpcomingAppointmentsController as AdminUpcomingAppointmentsController;
use App\Http\Controllers\Admin\ViewCustomersController;

// Auth
use App\Http\Controllers\Auth\AdminLoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\RegisterController;

// Customer
use App\Http\Controllers\Customer\BookAppointmentController;
use App\Http\Controllers\Customer\CustomerDashboardController;
use App\Http\Controllers\Customer\DiagnosticsController;
use App\Http\Controllers\Customer\CustomerInvoiceController;
use App\Http\Controllers\Customer\CustomerLoginController;
use App\Http\Controllers\Customer\BikeController;
use App\Http\Controllers\Customer\CustomerServiceHistoryController;
use App\Http\Controllers\Customer\CustomerInfoController;
use App\Http\Controllers\Customer\CustomerAppointmentController;

// Mechanic
use App\Http\Controllers\Mechanic\MechanicLoginController;
use App\Http\Controllers\Mechanic\MechanicDashboardController;
use App\Http\Controllers\Mechanic\MechanicDiagnosticsController;
use App\Http\Controllers\Mechanic\ServiceHistoryController;
use App\Http\Controllers\Mechanic\MechanicTodoController;
use App\Http\Controllers\Mechanic\MechanicInfoController;
use App\Http\Controllers\Mechanic\UpcomingAppointmentsController as MechanicUpcomingAppointmentsController;
use App\Http\Controllers\Mechanic\TodayAppointmentsController;
use App\Http\Controllers\Mechanic\MechanicCustomersController;

// ---------------------
// Public / Static
// ---------------------

// Home
Route::view('/', 'welcome')->name('home');

// Static pages
Route::view('/about', 'about')->name('about');
Route::view('/faq', 'faq')->name('faq');
Route::view('/offerings', 'offerings')->name('offerings');

// ---------------------
// Auth Routes
// ---------------------

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

// Shared Logout
Route::post('/logout', [LogoutController::class, 'logout'])->name('logout');

// ---------------------
// Admin Routes
// ---------------------

// Dashboard
Route::get('/admin/dashboard', [AdminDashboardController::class, 'index'])
    ->name('admin.dashboard');

// Settings (simple view for now)
Route::view('/admin/settings', 'admin.settings')
    ->name('admin.settings');

// Add Mechanic
Route::get('/admin/add-mechanic',  [AddMechanicController::class, 'showForm'])
    ->name('admin.add_mechanic.form');
Route::post('/admin/add-mechanic', [AddMechanicController::class, 'store'])
    ->name('admin.add_mechanic.store');

// Edit/Update Mechanic
Route::get('/admin/mechanics/{id}/edit', [AddMechanicController::class, 'edit'])
    ->name('admin.mechanics.edit');
Route::put('/admin/mechanics/{id}', [AddMechanicController::class, 'update'])
    ->name('admin.mechanics.update');

// Invoices
Route::get('/admin/invoices', [AdminInvoiceController::class, 'index'])
    ->name('admin.invoices');

// Appointments
Route::get('/admin/appointments/upcoming', [AdminUpcomingAppointmentsController::class, 'index'])
    ->name('admin.appointments.upcoming');

// Schedules
Route::get('/admin/schedule/create',  [CreateScheduleController::class, 'showForm'])
    ->name('admin.schedule.create');
Route::post('/admin/schedule/create', [CreateScheduleController::class, 'store'])
    ->name('admin.schedule.store');

// Manage the full weekly schedule (all mechanics at once)
Route::get('/admin/schedule/edit', [CreateScheduleController::class, 'editAll'])
    ->name('admin.schedule.edit');

Route::put('/admin/schedule/update', [CreateScheduleController::class, 'updateAll'])
    ->name('admin.schedule.update');

// Manage a single mechanic's weekly schedule
Route::get('/admin/mechanics/{id}/schedule', [CreateScheduleController::class, 'editForMechanic'])
    ->name('admin.mechanics.schedule.edit');

Route::put('/admin/mechanics/{id}/schedule', [CreateScheduleController::class, 'updateForMechanic'])
    ->name('admin.mechanics.schedule.update');

// Customers
Route::get('/admin/customers', [ViewCustomersController::class, 'index'])
    ->name('admin.customers');

// ---------------------
// Customer Routes
// ---------------------

Route::get('/customer/dashboard', [CustomerDashboardController::class, 'index'])
    ->name('customer.dashboard');

Route::get('/customer/book-appointment',  [BookAppointmentController::class, 'showForm'])
    ->name('customer.book_appointment.form');
Route::post('/customer/book-appointment', [BookAppointmentController::class, 'store'])
    ->name('customer.book_appointment.store');

Route::get('/customer/invoices', [CustomerInvoiceController::class, 'index'])
    ->name('customer.invoices');

Route::get('/customer/diagnostics', [DiagnosticsController::class, 'index'])
    ->name('customer.diagnostics');

Route::get('/customer/my-bike',  [BikeController::class, 'showForm'])
    ->name('customer.my_bike');
Route::post('/customer/my-bike', [BikeController::class, 'update'])
    ->name('customer.my_bike.update');

Route::get('/customer/service-history', [CustomerServiceHistoryController::class, 'index'])
    ->name('customer.service_history');

Route::view('/customer/settings', 'customer.settings')
    ->name('customer.settings');

Route::get('/customer/update-info',  [CustomerInfoController::class, 'showForm'])
    ->name('customer.update_info');
Route::post('/customer/update-info', [CustomerInfoController::class, 'update'])
    ->name('customer.update_info.submit');

// Customer Appointments
Route::get('/customer/appointments', [CustomerAppointmentController::class, 'index'])
    ->name('customer.appointments');
Route::delete('/customer/appointments/{id}', [CustomerAppointmentController::class, 'destroy'])
    ->name('customer.appointments.destroy');

// ---------------------
// Mechanic Routes
// ---------------------

Route::get('/mechanic/dashboard', [MechanicDashboardController::class, 'index'])
    ->name('mechanic.dashboard');

Route::get('/mechanic/diagnostics',  [MechanicDiagnosticsController::class, 'index'])
    ->name('mechanic.diagnostics');
Route::post('/mechanic/diagnostics', [MechanicDiagnosticsController::class, 'store'])
    ->name('mechanic.diagnostics.submit');

Route::get('/mechanic/service-history', [ServiceHistoryController::class, 'index'])
    ->name('mechanic.service_history');

Route::get('/mechanic/todo',         [MechanicTodoController::class, 'index'])
    ->name('mechanic.todo');
Route::post('/mechanic/todo/update', [MechanicTodoController::class, 'update'])
    ->name('mechanic.todo.update');

Route::get('/mechanic/upcoming-appointments', [MechanicUpcomingAppointmentsController::class, 'index'])
    ->name('mechanic.upcoming_appointments');

Route::get('/mechanic/update-info',  [MechanicInfoController::class, 'showForm'])
    ->name('mechanic.info');
Route::post('/mechanic/update-info', [MechanicInfoController::class, 'update'])
    ->name('mechanic.info.update');

Route::get('/mechanic/appointments/today', [TodayAppointmentsController::class, 'index'])
    ->name('mechanic.appointments.today');

Route::get('/mechanic/customers', [MechanicCustomersController::class, 'index'])
    ->name('mechanic.customers');