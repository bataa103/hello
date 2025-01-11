<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Middleware\UserMiddleware;
use App\Http\Controllers\User\CreditController;


Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', AdminMiddleware::class])->group(function () {
    Route::get('admin/dashboard', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');
});

Route::middleware(['auth', UserMiddleware::class])->prefix('user')->group(function () {
    Route::get('dashboard', function () {
        return view('user.dashboard');
    })->name('user.dashboard');

    Route::controller(CreditController::class)->group(function () {
        Route::get('credit', 'index')->name('user.credit.index');
        Route::post('credit', 'store')->name('user.credit.store');
        // Route::get('credit/{credit}', 'show')->name('user.credit.show');
        // Route::get('credit/{credit}/edit', 'edit')->name('user.credit.edit');
        // Route::put('credit/{credit}', 'update')->name('user.credit.update');
        // Route::delete('credit/{credit}', 'destroy')->name('user.credit.destroy');
    });
});

require __DIR__ . '/auth.php';
