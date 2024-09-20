<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ServiceController;
use Illuminate\Support\Facades\Route;

Route::get('/',[HomeController::class,'home']);

Route::get('/dashboard', function () {
    return view('home.index');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

Route::get('admin/dashboard',[HomeController::class,'index'])->middleware(['auth','admin']);
Route::get('/category', [HomeController::class, 'category'])->name('home.category');
Route::get('/order', [HomeController::class, 'order'])->name('home.order');
Route::get('/maid-service', [ServiceController::class, 'showMaidService'])->name('home.maidservice');
Route::get('/deep-cleaning-service', [ServiceController::class, 'showDeepCleaningService'])->name('home.deepcleaningservice');
