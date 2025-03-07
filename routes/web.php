<?php

use App\Http\Controllers\ItemController;
use App\Http\Controllers\PreviewController;
use App\Http\Controllers\ReportController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
	return Inertia::render('Welcome', [
		'canLogin'       => Route::has('login'),
		'canRegister'    => Route::has('register'),
		'laravelVersion' => Application::VERSION,
		'phpVersion'     => PHP_VERSION,
	]);
});

Route::middleware([
	'auth:sanctum',
	config('jetstream.auth_session'),
	'verified',
])->group(function () {
	Route::get('/dashboard', function () {
		return Inertia::render('Dashboard');
	})->name('dashboard');
	// Resource Routes
	Route::resource('items', ItemController::class);

	// Report Route
	Route::get('/report', [ReportController::class, 'ReportPage'])->name('report');

	// Report API
	Route::get("/sales-report/{FromDate}/{ToDate}", [ReportController::class, 'SalesReport'])->name('sales-report');
});

Route::get('/preview/{id}', [PreviewController::class, 'index'])->name('preview');
