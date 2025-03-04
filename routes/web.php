<?php
use App\Http\Controllers\DivisionController;
use App\Http\Controllers\InformationController;
use App\Http\Controllers\TaskSubmissionController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\InternRegisterController;
use App\Http\Controllers\InternController;
use App\Http\Controllers\InternQueueController;
use App\Http\Controllers\LogbookInternController;
use App\Http\Controllers\PresenceController;
use App\Http\Controllers\SchoolController;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('sigma-landing-page');
})->name('landing.page');

Route::get('/auth-login', function () {
    return view('login');
});

// Route::get('/dashboard', function () {
//     return view('intern.dashboard');
// })->middleware('checkRole:intern')->name('dashboard.intern');

Route::post('/transfer_to_intern', [InternQueueController::class, 'transferToIntern'])->name('internQueue.transferToIntern');

Route::prefix('master')->group(function () {
    Route::get('/interns', [InternController::class, 'index'])->name('interns.index');
    Route::delete('/intern/{id}', [InternController::class, 'destroy'])->name('master.intern.destroy');
    Route::get('/schools', [SchoolController::class, 'index'])->name('schools.index');
    Route::post('/schools', [SchoolController::class, 'store'])->name('schools.store');
    Route::delete('/school/{id}', [SchoolController::class, 'destroy'])->name('schools.destroy');
    Route::put('/school/{id}', [SchoolController::class, 'update'])->name('schools.update');
    Route::get('/divisions', [DivisionController::class, 'index'])->name('divisions.index');
    Route::post('/divisions', [DivisionController::class, 'store'])->name('divisions.store');
    Route::delete('/division/{id}', [DivisionController::class, 'destroy'])->name('divisions.destroy');
    Route::put('/division/{id}', [DivisionController::class, 'update'])->name('divisions.update');
});

Route::prefix('logbook')->group(function () {
    Route::get('/detail/{id}', [LogbookInternController::class, 'show'])->name('logbookIntern.show');
    Route::get('/edit/{id}', [LogbookInternController::class, 'edit'])->name('logbookIntern.edit');
    Route::put('/update/{id}', [LogbookInternController::class, 'update'])->name('logbookIntern.update');
    Route::get('/groupBy/{intern_id}', [LogbookInternController::class, 'showDetailLogbook'])->name('logbookIntern.showDetailLogbook');
});

Route::get('/detailQueue/{last_date_id?}', [InternQueueController::class, 'showDetailQueue'])
    ->name('internQueue.showDetailQueue');

Route::prefix('registration')->group(function () {
    Route::get('/list', [InternRegisterController::class, 'index'])->name('internRegister.index');
    Route::get('/list/{token}', [InternRegisterController::class, 'showByToken'])->name('internRegister.showByToken');
    Route::get('/queue', [InternQueueController::class, 'index'])->name('internQueue.index');
    Route::delete('/queue/{id}', [InternQueueController::class, 'destroy'])->name('internQueue.destroy');
    Route::post('/store', [InternRegisterController::class, 'store'])->name('internRegister.store');
    Route::post('/transfer', [InternRegisterController::class, 'transferAccepted'])->name('internRegister.transferAccepted');
    Route::post('/remove', [InternRegisterController::class, 'transferRejected'])->name('internRegister.transferRejected');
    Route::post('/updateStat', [InternRegisterController::class, 'updateStatus'])->name('internRegister.updateStatus');
    Route::post('/getDate', [InternController::class, 'getEndDateUnique'])->name('interns.getEndDateUnique');

    Route::get('/', function () {
        return view('register.dashboard_daftar');
    })->name('internRegister.daftar');
});

Route::prefix('monitoring')->group(function () {
    Route::get('/disposition', [InternController::class, 'dispositionIntern'])->name('monitoring.disposition.index');
    Route::put('/disposition/{id}', [InternController::class, 'updateDisposition'])->name('monitoring.disposition.update');
    Route::get('/information', [InformationController::class, 'index'])->name('monitoring.information.index');
    Route::get('/monitoring/information/{id}', [InformationController::class, 'show'])->name('monitoring.information.show');
    Route::post('/information', [InformationController::class, 'store'])->name('monitoring.information.store');
    Route::delete('/information/{id}', [InformationController::class, 'destroy'])->name('monitoring.information.destroy');
    Route::get('/information/edit/{id}', [InformationController::class, 'edit'])->name('monitoring.information.edit');
    Route::put('/information/{id}', [InformationController::class, 'update'])->name('monitoring.information.update');
    Route::get('/group-logbook', [LogbookInternController::class, 'getLogbookByIntern'])->name('monitoring.logbookIntern.getLogbookByIntern');
    Route::get('/group-presence', [PresenceController::class, 'getPrecencesByIntern'])->name('monitoring.presence.getPresence');
    Route::get('/groupBy/{intern_id}', [PresenceController::class, 'showDetailPresence'])->name('monitoring.presenceIntern.showDetailPresence');
    Route::get('/certificate-intern', [InternController::class, 'certificateIntern'])->name('monitoring.certificateIntern');
    Route::get('/submission', [TaskSubmissionController::class, 'index'])->name('monitoring.submission.index');
    Route::post('/submission', [TaskSubmissionController::class, 'store'])->name('monitoring.submission.store');
    Route::get('/task-submission/{taskId}', [InformationController::class, 'showSubmissionsByTask'])->name('monitoring.taskSubmission');
    Route::get('/task/{taskSubmission}/download', [InformationController::class, 'downloadSubmission'])->name('monitoring.taskSubmission.download');
});

Route::prefix('activity')->group(function () {
    Route::get('/logbooks', [LogbookInternController::class, 'index'])->name('activity.logbook');
    Route::get('/presences', [PresenceController::class, 'index'])->name('activity.presence.index');
    Route::post('/presences', [PresenceController::class, 'store'])->name('activity.presence.store');
});

Route::prefix('mentor')->group(function () {
    Route::get('/intern-by-division', [InternController::class, 'getInternsByDivision'])->name('mentor.internByDivision');
    Route::get('/intern-logbook/{internId}', [InternController::class, 'showLogbookByIntern'])->name('mentor.internLogbook');
    Route::get('/intern-logbook/create/{id}', [InternController::class, 'edit'])->name('mentor.internLogbook.edit');
    Route::put('/point-logbook/{id}', [InternController::class, 'updatePoint'])->name('mentor.updatePoint');
    Route::get('/presence-by-division', [PresenceController::class, 'presenceByDivision'])->name('mentor.presenceByDivision');
    Route::post('/presence-by-division', [PresenceController::class, 'storeByMentor'])->name('mentor.storePresencebyMentor');
    Route::get('/intern-presence/{internId}', [PresenceController::class, 'showPresenceByIntern'])->name('mentor.internPresence');
});

Route::prefix('cetak')->group(function () {
    Route::get('/logbooks', [LogbookInternController::class, 'logbooks'])->name('cetak.logbook');
    Route::get('/logbooks-export', [LogbookInternController::class, 'export'])->name('cetak.logbook.export');
    Route::get('/logbooks-intern-export', [LogbookInternController::class, 'exportLogbookIntern'])->name('cetak.logbook.intern.export');
    Route::get('/presences', [PresenceController::class, 'presences'])->name('cetak.presence');
    Route::get('/presences-export', [PresenceController::class, 'export'])->name('cetak.presence.export');
    Route::get('/presences-intern-export', [PresenceController::class, 'exportPresenceIntern'])->name('cetak.presence.intern.export');
    Route::get('/certificate/{id}', [InternController::class, 'certificatePDF'])->name('cetak.sertifikat');

});

Auth::routes();

Route::post('/logout', function () {
    Auth::logout();
    return redirect('/login'); // Ganti '/custom-redirect-url' dengan URL yang diinginkan
})->name('logout');



Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'index'])->name('dashboard');
