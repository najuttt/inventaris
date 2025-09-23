<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Role\SuperAdminController;
use App\Http\Controllers\Role\admin\AdminController;
use App\Http\Controllers\Role\admin\ItemoutController;
use App\Http\Controllers\Role\admin\RequestController;
use App\Http\Controllers\Role\admin\GuestController;
use App\Http\Controllers\Role\PegawaiController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\Item_inController;
use App\Http\Controllers\UnitController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ExportController;

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

        // Barcode
        Route::get('items/{item}/barcode-pdf', [ItemController::class, 'printBarcode'])
            ->name('items.barcode.pdf');

        //  Export Laporan
        // Barang Masuk
        Route::get('/export/barang-masuk/excel', [ExportController::class, 'exportBarangMasukExcel'])
            ->name('export.barang_masuk.excel');
        Route::get('/export/barang-masuk/pdf', [ExportController::class, 'exportBarangMasukPdf'])
            ->name('export.barang_masuk.pdf');

        // Barang Keluar
        Route::get('/export/barang-keluar/excel', [ExportController::class, 'exportBarangKeluarExcel'])
            ->name('export.barang_keluar.excel');
        Route::get('/export/barang-keluar/pdf', [ExportController::class, 'exportBarangKeluarPdf'])
            ->name('export.barang_keluar.pdf');
    });


Route::middleware(['auth', 'role:admin'])
    ->prefix('admin')
    ->as('admin.')
    ->group(function () {
        Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');
        Route::get('/dashboard/data', [AdminController::class, 'getChartData']);

        Route::get('/itemout', [ItemoutController::class, 'index'])->name('itemout');
        Route::post('/itemout/scan/{cartItem}', [ItemoutController::class, 'scan'])->name('itemout.scan');
        Route::post('/admin/itemout/scan/{id}', [ItemoutController::class, 'scan'])->name('admin.itemout.scan');
        Route::get('/itemout/{cart}/struk', [ItemoutController::class, 'struk'])->name('admin.itemout.struk');
        Route::get('/admin/itemout/struk/{id}', [ItemoutController::class, 'generateStruk'])->name('admin.itemout.struk');
        Route::get('/itemout/struk/{id}', [ItemoutController::class, 'generateStruk'])->name('itemout.struk');
        Route::get('/admin/itemout/receipt/{id}', [ItemoutController::class, 'receipt'])->name('admin.itemout.receipt');

        Route::get('/request', [RequestController::class, 'index'])->name('request');
        Route::resource('carts', RequestController::class);

        Route::resource('guests', GuestController::class);
    });


Route::middleware(['auth', 'role:pegawai'])
    ->prefix('pegawai')
    ->as('pegawai.')
    ->group(function () {
        Route::get('/dashboard', [PegawaiController::class, 'index'])->name('dashboard');
    });

require __DIR__.'/auth.php';
