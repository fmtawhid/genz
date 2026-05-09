<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;

Route::get('/', [PageController::class, 'index'])->name('home');
Route::get('/about', [PageController::class, 'about'])->name('about');

Route::get('/courses', [PageController::class, 'courses'])->name('courses');
Route::get('/course/{slug}', [PageController::class, 'courseDetails'])->name('course.details');

Route::get('/contact', [PageController::class, 'contact'])->name('contact');
Route::get('/success-stories', [PageController::class, 'successStories'])->name('success.stories');
Route::get('/admission', [PageController::class, 'admission'])->name('admission');


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware('auth')->name('dashboard');


require __DIR__.'/auth.php';
require __DIR__.'/merchant.php';
require __DIR__.'/admin.php';
