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

Route::get('/intern_register', function () {
    return view('intern_register');
});

Route::get('/auth-login', function () {
    return view('login');
});

Route::get('/dashboard', function () {
    return view('intern.dashboard');
})->middleware('checkRole:intern');

Route::get('/list_intern_registers', [InternRegisterController::class, 'index'])->name('internRegister.index');
Route::get('/intern_register', [InternRegisterController::class, 'create'])->name('internRegister.create');
Route::post('/intern_register', [InternRegisterController::class, 'store'])->name('internRegister.store');

Route::post('/update_status', [InternRegisterController::class, 'updateStatus'])->name('internRegister.updateStatus');
Route::get('/list_intern_register/{token}', [InternRegisterController::class, 'showByToken'])->name('internRegister.showByToken');
Route::post('/transfer_accepted', [InternRegisterController::class, 'transferAccepted'])->name('internRegister.transferAccepted');
Route::post('/transfer_rejected', [InternRegisterController::class, 'transferRejected'])->name('internRegister.transferRejected');

Route::get('/list_interns', [InternController::class, 'index'])->name('interns.index');
Route::post('/update_unique_endDate', [InternController::class, 'getEndDateUnique'])->name('interns.getEndDateUnique');

Route::get('/list_intern_queues', [InternQueueController::class, 'index'])->name('internQueue.index');
Route::get('/detailQueue/{last_date_id}', [InternQueueController::class, 'showDetailQueue'])->name('internQueue.showDetailQueue');

Route::post('/transfer_to_intern', [InternQueueController::class, 'transferToIntern'])->name('internQueue.transferToIntern');

//logbook route
Route::get('/logbook', [LogbookInternController::class, 'index'])->name('logbookIntern.index');
Route::get('/logbook/{id}', [LogbookInternController::class, 'show'])->name('logbookIntern.show');
Route::get('/logbook/{id}/edit', [LogbookInternController::class, 'edit'])->name('logbookIntern.edit');
Route::put('/logbook_update/{id}', [LogbookInternController::class,  'update'])->name('logbookIntern.update');
Route::get('/logbook_interns', [LogbookInternController::class, 'getLogbookByIntern'])->name('logbookIntern.getLogbookByIntern');
Route::get('/logbook_interns/{id}', [LogbookInternController::class, 'show']);
Route::get('/logbook_interns_by/{intern_id}', [LogbookInternController::class, 'showDetailLogbook'])->name('logbookIntern.showDetailLogbook');

Route::get('/sample', function () {

    return view('sample');
});

Auth::routes();

Route::post('/logout', function () {
    Auth::logout();
    return redirect('/login'); // Ganti '/custom-redirect-url' dengan URL yang diinginkan
})->name('logout');


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
