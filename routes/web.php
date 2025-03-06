<?php

use App\Http\Controllers\ItemController;
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
});

// Display a listing of the items
Route::get('items', [ItemController::class, 'index'])->name('items.index');

// Show the form for creating a new item
Route::get('items/create', [ItemController::class, 'create'])->name('items.create');

// Store a newly created item in storage
Route::post('items', [ItemController::class, 'store'])->name('items.store');

// Display the specified item
Route::get('items/{id}', [ItemController::class, 'show'])->name('items.show');

// Show the form for editing the specified item
Route::get('items/{id}/edit', [ItemController::class, 'edit'])->name('items.edit');

// Update the specified item in storage
Route::put('items/{id}', [ItemController::class, 'update'])->name('items.update');

// Remove the specified item from storage
Route::delete('items/{id}', [ItemController::class, 'destroy'])->name('items.destroy');
