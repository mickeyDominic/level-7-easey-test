<?php

use App\Http\Controllers\AppController;
use App\Http\Controllers\ProfileController;
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

Route::get('/add-user', [AppController::class, 'viewAddPage'])
    ->name('add-user');
Route::post('/add-user', [AppController::class, 'addRecord'])
    ->name('add-user');

Route::get('/list-users', [AppController::class, 'listUsers'])
    ->name('list-users');

require __DIR__.'/auth.php';
