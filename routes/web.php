<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\InternRegisterController;
use App\Http\Controllers\InternController;
use App\Http\Controllers\InternQueueController;
use App\Http\Controllers\LogbookInternController;
use App\Http\Middleware\CheckRoleFromSession;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('sigma-bps');
});

Route::get('/auth-login', function () {
    return view('login');
});

Route::get('/dashboard', function () {
    return view('intern.dashboard');
})->middleware('checkRole:intern');










Route::get('/detailQueue/{last_date_id}', [InternQueueController::class, 'showDetailQueue'])->name('internQueue.showDetailQueue');

Route::post('/transfer_to_intern', [InternQueueController::class, 'transferToIntern'])->name('internQueue.transferToIntern');

Route::prefix('master')->group(function (){
    Route::get('/interns', [InternController::class, 'index'])->name('interns.index');
});

Route::prefix('logbook')->group(function () {
    Route::get('/intern', [LogbookInternController::class, 'index'])->name('logbookIntern.index');
    Route::get('/interns', [LogbookInternController::class, 'getLogbookByIntern'])->name('logbookIntern.getLogbookByIntern');
    Route::get('/detail/{id}', [LogbookInternController::class, 'show'])->name('logbookIntern.show');
    Route::get('/edit/{id}', [LogbookInternController::class, 'edit'])->name('logbookIntern.edit');
    Route::put('/update/{id}', [LogbookInternController::class,  'update'])->name('logbookIntern.update');
    Route::get('/groupBy/{intern_id}', [LogbookInternController::class, 'showDetailLogbook'])->name('logbookIntern.showDetailLogbook');
});

Route::prefix('registration')->group(function () {
    Route::get('/list', [InternRegisterController::class, 'index'])->name('internRegister.index');
    Route::get('/list/{token}', [InternRegisterController::class, 'showByToken'])->name('internRegister.showByToken');
    Route::get('/queue', [InternQueueController::class, 'index'])->name('internQueue.index');
    Route::post('/store', [InternRegisterController::class, 'store'])->name('internRegister.store');
    Route::post('/transfer', [InternRegisterController::class, 'transferAccepted'])->name('internRegister.transferAccepted');
    Route::post('/remove', [InternRegisterController::class, 'transferRejected'])->name('internRegister.transferRejected');
    Route::post('/updateStat', [InternRegisterController::class, 'updateStatus'])->name('internRegister.updateStatus');
    Route::post('/getDate', [InternController::class, 'getEndDateUnique'])->name('interns.getEndDateUnique');

    Route::get('/', function () {
        return view('intern_register');
    })->name('internRegister.daftar');
});

Route::get('/sample', function () {

    return view('sample');
});

Auth::routes();

Route::post('/logout', function () {
    Auth::logout();
    return redirect('/login'); // Ganti '/custom-redirect-url' dengan URL yang diinginkan
})->name('logout');


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
