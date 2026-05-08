<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\MerchantsController;
use App\Http\Controllers\Admin\ProjectsController;
use App\Http\Controllers\Admin\TasksController;
use App\Http\Controllers\Admin\PosController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\SaleController;
use App\Http\Controllers\Admin\StockController;
use App\Http\Controllers\Admin\CustomerController;
use App\Http\Controllers\Admin\SupplierController;
use App\Http\Controllers\Admin\SalesmanController;
use App\Http\Controllers\Admin\ReportController;


Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {

    // Admin Dashboard
    Route::get('/', [AdminController::class, 'index'])->name('index');

    // POS View
    Route::get('/pos', [PosController::class, 'index'])->name('pos');

    // Products Routes
    Route::resource('products', ProductController::class, [
        'names' => [
            'index' => 'products.index',
            'create' => 'products.create',
            'store' => 'products.store',
            'show' => 'products.show',
            'edit' => 'products.edit',
            'update' => 'products.update',
            'destroy' => 'products.destroy',
        ]
    ]);

    // Stock Routes
    Route::prefix('stock')->name('stock.')->group(function () {
        Route::get('/create', [StockController::class, 'create'])->name('create');
    });

    // Customer Routes
    Route::prefix('customers')->name('customer.')->group(function () {
        Route::get('/', [CustomerController::class, 'index'])->name('list');
    });

    // Supplier Routes
    Route::prefix('suppliers')->name('supplier.')->group(function () {
        Route::get('/', [SupplierController::class, 'index'])->name('list');
    });

    // Salesman Routes
    Route::prefix('salesman')->name('salesman.')->group(function () {
        Route::get('/', [SalesmanController::class, 'index'])->name('list');
    });

    // Sales Routes
    Route::resource('sales', SaleController::class, [
        'names' => [
            'index' => 'sales.index',
            'create' => 'sales.create',
            'store' => 'sales.store',
            'show' => 'sales.show',
            'destroy' => 'sales.destroy',
        ]
    ]);

    // Reports Routes
    Route::prefix('reports')->name('reports.')->group(function () {
        Route::get('/', [ReportController::class, 'index'])->name('index');
        Route::get('/sales', [ReportController::class, 'sales'])->name('sales');
        Route::get('/products', [ReportController::class, 'products'])->name('products');
        Route::get('/merchants', [ReportController::class, 'merchants'])->name('merchants');
    });

    // Merchants CRUD
    Route::prefix('merchants')->name('merchant.')->group(function () {
        Route::get('/', [MerchantsController::class, 'index'])->name('list');
        Route::get('/create', [MerchantsController::class, 'create'])->name('create');
        Route::post('/store', [MerchantsController::class, 'store'])->name('store');
        Route::get('/{id}/edit', [MerchantsController::class, 'edit'])->name('edit');
        Route::put('/{id}/update', [MerchantsController::class, 'update'])->name('update');
        Route::delete('/{id}/destroy', [MerchantsController::class, 'destroy'])->name('destroy');
    });
});

