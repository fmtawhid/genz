<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\AdmissionController;

Route::get('/', [PageController::class, 'index'])->name('home');
Route::get('/about', [PageController::class, 'about'])->name('about');

Route::get('/courses', [PageController::class, 'courses'])->name('courses');
Route::get('/course/{slug}', [PageController::class, 'courseDetails'])->name('course.details');

Route::get('/contact', [PageController::class, 'contact'])->name('contact');
Route::post('/contact', [PageController::class, 'contactStore'])->name('contact.store');
Route::get('/success-stories', [PageController::class, 'successStories'])->name('success.stories');
Route::get('/admission', [AdmissionController::class, 'index'])
    ->name('admission');

Route::post('/admission/store', [AdmissionController::class, 'store'])
    ->name('admission.store');

require __DIR__.'/auth.php';
require __DIR__.'/merchant.php';
require __DIR__.'/admin.php';
