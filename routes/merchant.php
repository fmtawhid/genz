<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Merchant\AdminController as MerchantDashboard;
use App\Http\Controllers\Merchant\SettingController;
use App\Http\Controllers\Merchant\ProjectsController;
use App\Http\Controllers\Merchant\PosController;

Route::middleware(['auth','merchant'])->prefix('merchant')->name('merchant.')->group(function() {
    Route::get('/', [MerchantDashboard::class, 'index'])->name('index');
    Route::get('/settings', [SettingController::class, 'index'])->name('settings.edit');
    Route::put('/settings', [SettingController::class, 'update'])->name('settings.update');
    
    // POS Routes
    Route::get('/pos', [PosController::class, 'index'])->name('pos.index');

});




