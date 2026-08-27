<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\MerchantsController;
use App\Http\Controllers\Admin\ProjectsController;
use App\Http\Controllers\Admin\TasksController;
use App\Http\Controllers\Admin\CourseController;
use App\Http\Controllers\Admin\AdmissionController;
use App\Http\Controllers\Admin\SuccessStoryController;
use App\Http\Controllers\Admin\ContactMessageController;
use App\Http\Controllers\Admin\ReviewController;

Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {

    // ================= ADMIN DASHBOARD =================
    Route::get('/', [AdminController::class, 'index'])->name('index');

    // ================= MERCHANTS CRUD =================
    Route::prefix('students')->name('merchant.')->group(function () {
        Route::get('/', [MerchantsController::class, 'index'])->name('list');
        Route::get('/create', [MerchantsController::class, 'create'])->name('create');
        Route::post('/store', [MerchantsController::class, 'store'])->name('store');
        Route::get('/{id}/edit', [MerchantsController::class, 'edit'])->name('edit');
        Route::put('/{id}/update', [MerchantsController::class, 'update'])->name('update');
        Route::delete('/{id}/destroy', [MerchantsController::class, 'destroy'])->name('destroy');
        Route::get('/{id}', [MerchantsController::class, 'show'])->name('show');
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
        Route::get('/{id}', [CourseController::class, 'show'])->name('show');
        // ================= LESSONS (INSIDE COURSE) =================
        Route::post('/{course}/lessons/store', [CourseController::class, 'storeLesson'])
            ->name('lessons.store');

        Route::put('/lessons/{id}/update', [CourseController::class, 'updateLesson'])
            ->name('lessons.update');

        Route::delete('/lessons/{id}/destroy', [CourseController::class, 'deleteLesson'])
            ->name('lessons.destroy');
    });

    // ================= SUCCESS STORIES CRUD =================
    Route::prefix('success-stories')->name('success-stories.')->group(function () {
        Route::get('/', [SuccessStoryController::class, 'index'])->name('index');
        Route::get('/create', [SuccessStoryController::class, 'create'])->name('create');
        Route::post('/store', [SuccessStoryController::class, 'store'])->name('store');
        Route::get('/{id}/edit', [SuccessStoryController::class, 'edit'])->name('edit');
        Route::put('/{id}/update', [SuccessStoryController::class, 'update'])->name('update');
        Route::delete('/{id}/destroy', [SuccessStoryController::class, 'destroy'])->name('destroy');
        Route::get('/{id}', [SuccessStoryController::class, 'show'])->name('show');
    });

    // ================= CONTACT MESSAGES =================
    Route::prefix('contact-messages')->name('contact-messages.')->group(function () {
        Route::get('/', [ContactMessageController::class, 'index'])->name('index');
        Route::get('/{id}', [ContactMessageController::class, 'show'])->name('show');
        Route::delete('/{id}/destroy', [ContactMessageController::class, 'destroy'])->name('destroy');
    });

    // ================= REVIEWS CRUD =================
    Route::prefix('reviews')->name('reviews.')->group(function () {
        Route::get('/', [ReviewController::class, 'index'])->name('index');
        Route::get('/create', [ReviewController::class, 'create'])->name('create');
        Route::post('/store', [ReviewController::class, 'store'])->name('store');
        Route::get('/{id}/edit', [ReviewController::class, 'edit'])->name('edit');
        Route::put('/{id}/update', [ReviewController::class, 'update'])->name('update');
        Route::delete('/{id}/destroy', [ReviewController::class, 'destroy'])->name('destroy');
    });

    // ================= GENERAL TASKS =================
    Route::get('tasks', [TasksController::class, 'generalIndex'])->name('tasks.index');


    // ================= ADMISSIONS =================
    Route::prefix('admissions')->name('admissions.')->group(function () {

        Route::get('/', [AdmissionController::class, 'index'])
            ->name('index');

        Route::get('/{id}', [AdmissionController::class, 'show'])
            ->name('show');

        Route::put('/{id}/status', [AdmissionController::class, 'updateStatus'])
            ->name('status');

        Route::delete('/{id}/destroy', [AdmissionController::class, 'destroy'])
            ->name('destroy');

    });
});