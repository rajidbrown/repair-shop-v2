<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AvailableTimesController;

Route::get('/get-available-times', [AvailableTimesController::class, 'index']);
Route::get('/test', function () {
    return ['message' => 'API is working'];
});