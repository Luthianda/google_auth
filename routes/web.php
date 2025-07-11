<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    if (Auth::user()->id_level === 1) {
        return view('admin.dashboard');
    } elseif (Auth::user()->id_level === 2) {
        return view('user.dashboard');
    }

})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('auth/google', [HomeController::class, 'redirect'])->name('google-auth');
Route::get('auth/google/call-back', [HomeController::class, 'CallbackGoogle']);

require __DIR__ . '/auth.php';

Route::middleware(['auth', 'admin'])->group(function () {
    // middleware untuk bagian admin
    route::get('admin/dashboard', [HomeController::class, 'indexAdmin']);
});

Route::middleware(['auth', 'user'])->group(function () {
    // middleware untuk bagian user
    route::get('user/dashboard', [HomeController::class, 'indexUser']);
});


