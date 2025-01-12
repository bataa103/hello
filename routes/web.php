<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Middleware\UserMiddleware;
use App\Http\Controllers\User\CreditController;
use App\Http\Controllers\User\ExpenseController;
use App\Http\Controllers\User\IncomeController;


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
        Route::put('credit/{id}', 'update')->name('user.credit.update');
        Route::delete('credit/{id}', 'destroy')->name('user.credit.destroy');
    });

    Route::controller(ExpenseController::class)->group(function(){
        Route::get('expense','index')->name('user.expense.index');
        Route::post('expense', 'store')->name('user.expense.store');
        Route::put('expense/{id}', 'update')->name('user.expense.update');
        Route::delete('expense/{id}', 'destroy')->name('user.expense.destroy');
    });

    Route::controller(IncomeController::class)->group(function(){
        Route::get('income','index')->name('user.income.index');
        Route::post('income', 'store')->name('user.income.store');
        Route::put('income/{id}', 'update')->name('user.income.update');
        Route::delete('incomee/{id}', 'destroy')->name('user.income.destroy');
    });
});

require __DIR__ . '/auth.php';
