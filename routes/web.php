<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ServiceController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

Route::get('admin/dashboard',[HomeController::class,'index'])->middleware(['auth','admin']);

Route::get('view_category',[CategoryController::class,'view_category'])->middleware(['auth','admin']);
Route::post('add_category',[CategoryController::class,'add_category'])->middleware(['auth','admin']);
Route::get('delete_category/{id}',[CategoryController::class,'delete_category'])->middleware(['auth','admin']);
Route::get('edit_category/{id}',[CategoryController::class,'edit_category'])->middleware(['auth','admin']);
Route::post('update_category/{id}',[CategoryController::class,'update_category'])->middleware(['auth','admin']);

Route::get('add_service',[ServiceController::class,'add_service'])->middleware(['auth','admin']);
Route::post('upload_service',[ServiceController::class,'upload_service'])->middleware(['auth','admin']);
Route::get('view_service',[ServiceController::class,'view_service'])->middleware(['auth','admin']);
Route::get('delete_service/{id}',[ServiceController::class,'delete_service'])->middleware(['auth','admin']);
