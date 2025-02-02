<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Middleware\UserMiddleware;
use App\Http\Controllers\User\CreditController;
use App\Http\Controllers\User\ExpenseController;
use App\Http\Controllers\User\IncomeController;
use App\Http\Controllers\User\DashboardController;
use App\Http\Controllers\Admin\PlanController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Admin\MessageController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\UserMessageController;

use App\Models\User;
use App\Models\Plan;
use App\Models\Message;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;








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


Route::middleware([AdminMiddleware::class])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        // Admin dashboard route
        Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');

        Route::controller(PlanController::class)->prefix('plan')->name('plan.')->group(function () {
            Route::get('/', 'index')->name('index');
            Route::post('/', 'store')->name('store');
            Route::put('/{id}', 'update')->name('update');
            Route::delete('/{id}', 'destroy')->name('destroy');
        });



        // Admin Messages Route
        Route::get('/messages', [MessageController::class, 'index'])->name('messages.index');




        // User management resource routes
        Route::resource('users', UserController::class)->except(['show']);

        // Import users
        Route::post('/users/import', [UserController::class, 'import'])->name('users.import');
    });



Route::middleware(['auth', UserMiddleware::class])
    ->prefix('user')
    ->name('user.')
    ->group(function () {
        // User Dashboard Route
        Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');

        // Credit Routes
        Route::controller(CreditController::class)->prefix('credit')->name('credit.')->group(function () {
            Route::get('/', 'index')->name('index');
            Route::post('/', 'store')->name('store');
            Route::put('/{id}', 'update')->name('update');
            Route::delete('/{id}', 'destroy')->name('destroy');
        });

        // Expense Routes
        Route::controller(ExpenseController::class)->prefix('expense')->name('expense.')->group(function () {
            Route::get('/', 'index')->name('index');
            Route::post('/', 'store')->name('store');
            Route::put('/{id}', 'update')->name('update');
            Route::delete('/{id}', 'destroy')->name('destroy');
            Route::get('/type', 'type')->name('type'); // Income Type Chart
            Route::post('/expense/import', [ExpenseController::class, 'import'])->name('expense.import');
        });

        // Income Routes
        Route::controller(IncomeController::class)->prefix('income')->name('income.')->group(function () {
            Route::get('/', 'index')->name('index'); // Income listing
            Route::post('/', 'store')->name('store'); // Create income
            Route::put('/{id}', 'update')->name('update'); // Update income
            Route::delete('/{id}', 'destroy')->name('destroy'); // Delete income
            Route::get('/type', 'type')->name('type'); // Income Type Chart
            Route::get('/income/total', [IncomeController::class, 'getIncomeByDate'])->name('income.total');
            Route::post('/income/import', [IncomeController::class, 'import'])->name('income.import');
            Route::post('/import', 'import')->name('import');

            // nemsen
            Route::get('/date', 'getIncomeByDate')->name('byDate');

        });

        Route::post('/messages', [UserMessageController::class, 'store'])->name('messages.store');
        Route::get('/messages', [UserMessageController::class, 'index']);
    });


require __DIR__ . '/auth.php';

// Route::middleware(['auth', UserMiddleware::class])
//     ->prefix('user')
//     ->name('user.')
//     ->group(function () {

//         // User Dashboard Route
//         Route::get('dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');
