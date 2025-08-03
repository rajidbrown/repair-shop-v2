<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AddMechanicController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\InvoiceController;
use App\Http\Controllers\Admin\UpcomingAppointmentsController;
use App\Http\Controllers\Admin\ScheduleController;
use App\Http\Controllers\Customer\BookAppointmentController;
use App\Http\Controllers\Customer\CustomerDashboardController;
use App\Http\Controllers\Customer\DiagnosticsController;

// Landing page
Route::get('/', function () {
    return view('welcome');
})->name('home');

// Static pages
Route::view('/about', 'about')->name('about');
Route::view('/faq', 'faq')->name('faq');
Route::view('/offerings', 'offerings')->name('offerings'); // ✅ Added
Route::view('/register', 'auth.register')->name('register'); // ✅ Added
Route::view('/login/customer', 'auth.login_customer')->name('login.customer'); // ✅ Added
Route::view('/login/mechanic', 'auth.login_mechanic')->name('login.mechanic'); // ✅ Added
Route::view('/login/admin', 'auth.login_admin')->name('login.admin'); // ✅ Added

// Admin - Dashboard
Route::get('/admin/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');

// Admin - Add Mechanic
Route::get('/admin/add-mechanic', [AddMechanicController::class, 'showForm'])->name('admin.add_mechanic.form');
Route::post('/admin/add-mechanic', [AddMechanicController::class, 'store'])->name('admin.add_mechanic.store');

// Admin - Invoices
Route::get('/admin/invoices', [InvoiceController::class, 'index'])->name('admin.invoices');

// Admin - Upcoming Appointments
Route::get('/admin/appointments/upcoming', [UpcomingAppointmentsController::class, 'index'])->name('admin.appointments.upcoming');

// Admin - Create Schedule
Route::get('/admin/schedule/create', [ScheduleController::class, 'showForm'])->name('admin.schedule.form');
Route::post('/admin/schedule/create', [ScheduleController::class, 'store'])->name('admin.schedule.store');

// Customer - Dashboard
Route::get('/customer/dashboard', [CustomerDashboardController::class, 'index'])->name('customer.dashboard');

// Customer - Book Appointment
Route::get('/customer/book-appointment', [BookAppointmentController::class, 'showForm'])->name('customer.book_appointment.form');
Route::post('/customer/book-appointment', [BookAppointmentController::class, 'store'])->name('customer.book_appointment.store');

// Customer - Diagnostics
Route::get('/customer/diagnostics', [DiagnosticsController::class, 'index'])->name('customer.diagnostics');