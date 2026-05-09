<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\MerchantsController;
use App\Http\Controllers\Admin\ProjectsController;
use App\Http\Controllers\Admin\TasksController;
use App\Http\Controllers\Admin\CourseController;

Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {

    // ================= ADMIN DASHBOARD =================
    Route::get('/', [AdminController::class, 'index'])->name('index');

    // ================= MERCHANTS CRUD =================
    Route::prefix('merchants')->name('merchant.')->group(function () {
        Route::get('/', [MerchantsController::class, 'index'])->name('list');
        Route::get('/create', [MerchantsController::class, 'create'])->name('create');
        Route::post('/store', [MerchantsController::class, 'store'])->name('store');
        Route::get('/{id}/edit', [MerchantsController::class, 'edit'])->name('edit');
        Route::put('/{id}/update', [MerchantsController::class, 'update'])->name('update');
        Route::delete('/{id}/destroy', [MerchantsController::class, 'destroy'])->name('destroy');
    });

    // ================= PROJECTS CRUD =================
    Route::prefix('projects')->name('project.')->group(function () {
        Route::get('/', [ProjectsController::class, 'index'])->name('list');
        Route::get('/create', [ProjectsController::class, 'create'])->name('create');
        Route::post('/store', [ProjectsController::class, 'store'])->name('store');
        Route::get('/{id}/edit', [ProjectsController::class, 'edit'])->name('edit');
        Route::put('/{id}/update', [ProjectsController::class, 'update'])->name('update');
        Route::delete('/{id}/destroy', [ProjectsController::class, 'destroy'])->name('destroy');

        // ================= TASKS UNDER PROJECTS =================
        Route::prefix('{project}/tasks')->name('tasks.')->group(function () {
            Route::get('/', [TasksController::class, 'index'])->name('index');
            Route::get('/create', [TasksController::class, 'create'])->name('create');
            Route::post('/store', [TasksController::class, 'store'])->name('store');
            Route::get('/{task}/edit', [TasksController::class, 'edit'])->name('edit');
            Route::put('/{task}/update', [TasksController::class, 'update'])->name('update');
            Route::delete('/{task}/destroy', [TasksController::class, 'destroy'])->name('destroy');
        });
    });

    // ================= COURSES (NEW EDTECH MODULE) =================
    Route::prefix('courses')->name('courses.')->group(function () {
        Route::get('/', [CourseController::class, 'index'])->name('index');
        Route::get('/create', [CourseController::class, 'create'])->name('create');
        Route::post('/store', [CourseController::class, 'store'])->name('store');
        Route::get('/{id}/edit', [CourseController::class, 'edit'])->name('edit');
        Route::put('/{id}/update', [CourseController::class, 'update'])->name('update');
        Route::delete('/{id}/destroy', [CourseController::class, 'destroy'])->name('destroy');

        // ================= LESSONS (INSIDE COURSE) =================
        Route::post('/{course}/lessons/store', [CourseController::class, 'storeLesson'])
            ->name('lessons.store');

        Route::put('/lessons/{id}/update', [CourseController::class, 'updateLesson'])
            ->name('lessons.update');

        Route::delete('/lessons/{id}/destroy', [CourseController::class, 'deleteLesson'])
            ->name('lessons.destroy');
    });

    // ================= GENERAL TASKS =================
    Route::get('tasks', [TasksController::class, 'generalIndex'])->name('tasks.index');

});