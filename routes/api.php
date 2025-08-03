<?php 

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AvailableTimesController;

Route::get('/available-times', [AvailableTimesController::class, 'index']);