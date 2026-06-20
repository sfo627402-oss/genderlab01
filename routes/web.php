<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\BiologistController;
use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/verify/{qr_code}', [DashboardController::class, 'verifyQr'])->name('verify.qr');

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Client Routes
    Route::prefix('client')->name('client.')->group(function () {
        Route::get('/instructions', [ClientController::class, 'instructionsPage'])->name('instructions');
        Route::get('/submit', [ClientController::class, 'submitForm'])->name('submit');
        Route::post('/submit', [ClientController::class, 'storeSample'])->name('store');
        Route::get('/sample/{id}', [ClientController::class, 'showSample'])->name('sample.show');
        Route::get('/sample/{id}/pdf', [ClientController::class, 'printReport'])->name('sample.pdf');
    });

    // Biologist Routes
    Route::prefix('lab')->name('lab.')->group(function () {
        Route::get('/scan', [BiologistController::class, 'scanQr'])->name('scan');
        Route::get('/samples', [BiologistController::class, 'index'])->name('samples');
        Route::get('/sample/{id}', [BiologistController::class, 'showSample'])->name('sample.show');
        Route::post('/sample/{id}/status', [BiologistController::class, 'updateStatus'])->name('sample.status');
        Route::post('/sample/{id}/analyze', [BiologistController::class, 'submitAnalysis'])->name('sample.analyze');
    });

    // Admin Routes
    Route::prefix('admin')->name('admin.')->group(function () {
        Route::get('/', [AdminController::class, 'index'])->name('index');
        Route::post('/sample/{id}/access', [AdminController::class, 'toggleClientAccess'])->name('sample.access');
        Route::delete('/sample/{id}', [AdminController::class, 'destroySample'])->name('sample.destroy');
    });
});

require __DIR__.'/auth.php';
