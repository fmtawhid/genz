<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Merchant\AdminController as MerchantDashboard;
use App\Http\Controllers\Merchant\SettingController;
use App\Http\Controllers\Merchant\ProjectsController;

Route::prefix('student')->name('merchant.')->group(function () {
    Route::get('/certificates/verify/{token}', [\App\Http\Controllers\Merchant\CertificatesController::class, 'verify'])
        ->name('certificates.verify');
});

Route::middleware(['auth','merchant'])->prefix('student')->name('merchant.')->group(function() {
    Route::get('/', [MerchantDashboard::class, 'index'])->name('index');
    Route::get('/settings', [SettingController::class, 'index'])->name('settings.edit');
    Route::put('/settings', [SettingController::class, 'update'])->name('settings.update');

    // Projects Routes
    Route::get('/projects', [ProjectsController::class, 'index'])->name('projects.index');
    Route::get('/projects/{id}', [ProjectsController::class, 'show'])->name('projects.show');
    Route::post('/projects/{id}/join', [ProjectsController::class, 'join'])->name('projects.join');
    Route::post('/projects/{id}/leave', [ProjectsController::class, 'leave'])->name('projects.leave');
    Route::get('/my-projects', [ProjectsController::class, 'myProjects'])->name('projects.my');
    
    
    // ================= COURSES =================
    Route::get('/courses', [\App\Http\Controllers\Merchant\CoursesController::class, 'index'])
        ->name('courses.index');

    Route::get('/courses/{id}', [\App\Http\Controllers\Merchant\CoursesController::class, 'show'])
        ->name('courses.show');

    // ================= CERTIFICATES =================
    Route::get('/certificates', [\App\Http\Controllers\Merchant\CertificatesController::class, 'index'])
        ->name('certificates.index');

    Route::get('/certificates/{id}', [\App\Http\Controllers\Merchant\CertificatesController::class, 'show'])
        ->name('certificates.show');

    Route::get('/certificates/{id}/download', [\App\Http\Controllers\Merchant\CertificatesController::class, 'download'])
        ->name('certificates.download');
});




