<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Role\SuperAdminController;
use App\Http\Controllers\Role\AdminController;
use App\Http\Controllers\Role\PegawaiController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\Item_inController;
use App\Http\Controllers\UnitController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\UserController;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'role:super_admin'])
    ->prefix('super-admin')
    ->as('super_admin.')
    ->group(function () {
        Route::get('/dashboard', [SuperAdminController::class, 'index'])->name('dashboard');

        // CRUD Master Data
        Route::resource('categories', CategoryController::class);
        Route::resource('items', ItemController::class);
        Route::resource('item_ins', Item_inController::class);
        Route::resource('units', UnitController::class);
        Route::resource('suppliers', SupplierController::class);
        Route::resource('users', UserController::class);

        //Barcode
        Route::get('items/{item}/barcode-pdf', [ItemController::class, 'printBarcode'])
            ->name('items.barcode.pdf');
    });

Route::middleware(['auth', 'role:admin'])
    ->prefix('admin')
    ->as('admin.')
    ->group(function () {
        Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');
    });

Route::middleware(['auth', 'role:pegawai'])
    ->prefix('pegawai')
    ->as('pegawai.')
    ->group(function () {
        Route::get('/dashboard', [PegawaiController::class, 'index'])->name('dashboard');
    });

require __DIR__.'/auth.php';
