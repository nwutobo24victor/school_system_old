<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SigninController;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware('guest')->group(function () {
    Route::get('staff/signin', [SigninController::class, 'create'])->name('signin');
    Route::post('staff/signin', [SigninController::class, 'store'])->name('signin');
    Route::post('/signout', [SigninController::class, 'signout'])->name('signout');
});

Route::get('/dashboard', function () {
    return view('dash');
})->middleware(['auth', 'verified'])->name('dashboard');



// require __DIR__.'/auth.php';
// require __DIR__.'/admin.php';
