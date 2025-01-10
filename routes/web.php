<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Controllers\Admin\IncomeController;
use App\Http\Controllers\SaveController;


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
    Route::get('/admin/dashboard', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');

    Route::controller(IncomeController::class)->group(function () {
        Route::get('admin/income', 'index')->name('admin.income.index');
        Route::get('admin/income/create', 'create')->name('admin.income.create');
        Route::post('admin/income/store', 'store')->name('admin.income.store');
        Route::get('admin/income/{id}', 'show')->name('admin.income.show');
        Route::get('admin/income/{id}/edit', 'edit')->name('admin.income.edit');
        Route::put('admin/income/{id}', 'update')->name('admin.income.update');
        Route::delete('admin/income/{id}', 'destroy')->name('admin.income.destroy');
    });
});


Route::middleware(['auth', AdminMiddleware::class])->group(function () {
    Route::prefix('admin')->group(function () {
        Route::controller(SaveController::class)->group(function () {
            Route::get('save', 'index')->name('admin.save.index');              // List all saves
            Route::get('save/create', 'create')->name('admin.save.create');     // Create form
            Route::post('save', 'store')->name('admin.save.store');             // Store new save
            Route::get('save/{save}', 'show')->name('admin.save.show');         // View save details
            Route::get('save/{save}/edit', 'edit')->name('admin.save.edit');    // Edit form
            Route::put('save/{save}', 'update')->name('admin.save.update');     // Update save
            Route::delete('save/{save}', 'destroy')->name('admin.save.destroy');// Delete save
        });
    });
});




require __DIR__.'/auth.php';
