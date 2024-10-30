<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\InternRegisterController;

Route::get('/', function () {
    return view('sigma-bps');
});

Route::get('/intern_register', function () {
    return view('intern_register');
});

Route::get('/auth-login', function () {
    return view('login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
});

Route::get('/list_intern_registers', [InternRegisterController::class, 'index'])->name('internRegister.index');
Route::get('/intern_register', [InternRegisterController::class, 'create'])->name('internRegister.create');
Route::post('/intern_register', [InternRegisterController::class, 'store'])->name('internRegister.store');


Route::get('/sample', function () {
    return view('sample');
});
