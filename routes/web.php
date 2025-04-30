<?php

use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


// Route for the dashboard
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');