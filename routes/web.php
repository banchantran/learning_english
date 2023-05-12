<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::get('/', [\App\Http\Controllers\CategoryController::class, 'index'])->name('home');

Route::prefix('category')->name('category.')->group(function() {
    Route::get('/', [\App\Http\Controllers\CategoryController::class, 'index'])->name('index');
    Route::get('/show/{id}', [\App\Http\Controllers\CategoryController::class, 'show'])->name('show');
    Route::get('/delete/{id}', [\App\Http\Controllers\CategoryController::class, 'delete'])->name('delete');
    Route::post('/store', [\App\Http\Controllers\CategoryController::class, 'store'])->name('store');
});

Route::prefix('category/{categoryId}/lesson')->name('lesson.')->group(function() {
    Route::get('/', [\App\Http\Controllers\LessonController::class, 'index'])->name('index');
    Route::post('/store', [\App\Http\Controllers\LessonController::class, 'store'])->name('store');
    Route::post('/update', [\App\Http\Controllers\LessonController::class, 'update'])->name('update');
    Route::get('/show/{lessonId}', [\App\Http\Controllers\LessonController::class, 'show'])->name('show');
    Route::get('/delete/{lessonId}', [\App\Http\Controllers\LessonController::class, 'delete'])->name('delete');
});

Route::prefix('learning')->name('learning.')->group(function() {
    Route::get('/lesson/{lessonId}', [\App\Http\Controllers\LearningController::class, 'show'])->name('show');
    Route::get('/lesson/{lessonId}/markCompleted', [\App\Http\Controllers\LearningController::class, 'markCompleted'])->name('mark_completed');
});

Route::prefix('bookmark')->name('bookmark.')->group(function() {
    Route::get('/list', [\App\Http\Controllers\BookmarkController::class, 'getList'])->name('list');
    Route::get('/store/{itemId}', [\App\Http\Controllers\BookmarkController::class, 'store'])->name('store');
});