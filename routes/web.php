<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HistoryController;
use App\Http\Controllers\ExportController;
use App\Http\Controllers\EducationController;
use App\Http\Controllers\FaqController;
use App\Http\Controllers\ReminderController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\GuestController;
use App\Http\Controllers\Kalkulator\PPh21Controller;
use App\Http\Controllers\Kalkulator\TakeHomePayController;
use App\Http\Controllers\Kalkulator\ThrBonusController;
use App\Http\Controllers\Kalkulator\GrossUpController;
use App\Http\Controllers\Kalkulator\PPNController;
use App\Http\Controllers\Kalkulator\UMKMController;
use App\Http\Controllers\Kalkulator\FreelancerController;
use App\Http\Controllers\Kalkulator\BadanController;
use App\Http\Controllers\Kalkulator\DividenController;
use App\Http\Controllers\Kalkulator\PropertiController;
use App\Http\Controllers\Kalkulator\KendaraanController;
use App\Http\Controllers\Kalkulator\SimulasiController;
use Illuminate\Support\Facades\Route;

Route::get('/', [GuestController::class, 'index'])->name('guest.index');
Route::get('/guest/{kalkulator}', [GuestController::class, 'kalkulator'])->name('guest.kalkulator');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::prefix('kalkulator')->name('kalkulator.')->group(function () {
        Route::get('/pph21', [PPh21Controller::class, 'index'])->name('pph21');
        Route::post('/pph21/calculate', [PPh21Controller::class, 'calculate'])->name('pph21.calculate');

        Route::get('/take-home-pay', [TakeHomePayController::class, 'index'])->name('take-home-pay');
        Route::post('/take-home-pay/calculate', [TakeHomePayController::class, 'calculate'])->name('take-home-pay.calculate');

        Route::get('/thr-bonus', [ThrBonusController::class, 'index'])->name('thr-bonus');
        Route::post('/thr-bonus/calculate', [ThrBonusController::class, 'calculate'])->name('thr-bonus.calculate');

        Route::get('/gross-up', [GrossUpController::class, 'index'])->name('gross-up');
        Route::post('/gross-up/calculate', [GrossUpController::class, 'calculate'])->name('gross-up.calculate');

        Route::get('/ppn', [PPNController::class, 'index'])->name('ppn');
        Route::post('/ppn/calculate', [PPNController::class, 'calculate'])->name('ppn.calculate');

        Route::get('/umkm', [UMKMController::class, 'index'])->name('umkm');
        Route::post('/umkm/calculate', [UMKMController::class, 'calculate'])->name('umkm.calculate');

        Route::get('/freelancer', [FreelancerController::class, 'index'])->name('freelancer');
        Route::post('/freelancer/calculate', [FreelancerController::class, 'calculate'])->name('freelancer.calculate');

        Route::get('/badan', [BadanController::class, 'index'])->name('badan');
        Route::post('/badan/calculate', [BadanController::class, 'calculate'])->name('badan.calculate');

        Route::get('/dividen', [DividenController::class, 'index'])->name('dividen');
        Route::post('/dividen/calculate', [DividenController::class, 'calculate'])->name('dividen.calculate');

        Route::get('/properti', [PropertiController::class, 'index'])->name('properti');
        Route::post('/properti/calculate', [PropertiController::class, 'calculate'])->name('properti.calculate');

        Route::get('/kendaraan', [KendaraanController::class, 'index'])->name('kendaraan');
        Route::post('/kendaraan/calculate', [KendaraanController::class, 'calculate'])->name('kendaraan.calculate');

        Route::get('/simulasi', [SimulasiController::class, 'index'])->name('simulasi');
        Route::post('/simulasi/calculate', [SimulasiController::class, 'calculate'])->name('simulasi.calculate');
    });

    Route::resource('history', HistoryController::class)->only(['index', 'show', 'destroy']);

    Route::prefix('export')->name('export.')->group(function () {
        Route::get('/pdf/{calculation}', [ExportController::class, 'pdf'])->name('pdf');
        Route::get('/excel/{calculation}', [ExportController::class, 'excel'])->name('excel');
        Route::get('/excel-all', [ExportController::class, 'excelAll'])->name('excel-all');
    });

    Route::get('/edukasi', [EducationController::class, 'index'])->name('education.index');
    Route::get('/edukasi/{article}', [EducationController::class, 'show'])->name('education.show');

    Route::get('/faq', [FaqController::class, 'index'])->name('faq.index');

    Route::resource('reminder', ReminderController::class)->except(['show']);
    Route::get('/kalender', [ReminderController::class, 'kalender'])->name('kalender');
    Route::patch('/reminder/{reminder}/done', [ReminderController::class, 'toggleDone'])->name('reminder.toggle');

    Route::get('/notifications', [NotificationController::class, 'index'])->name('notifications.index');
    Route::post('/notifications/{notification}/read', [NotificationController::class, 'markRead'])->name('notifications.read');
    Route::post('/notifications/read-all', [NotificationController::class, 'markAllRead'])->name('notifications.read-all');

    Route::post('/favorites/toggle', [DashboardController::class, 'toggleFavorite'])->name('favorites.toggle');

    Route::post('/profile/set-active', [ProfileController::class, 'setActiveProfile'])->name('profile.set-active');
    Route::get('/profile/manage', [ProfileController::class, 'manage'])->name('profile.manage');
    Route::post('/profile', [ProfileController::class, 'store'])->name('profile.store');
    Route::put('/profile/{profile}', [ProfileController::class, 'updateProfile'])->name('profile.update-profile');
    Route::delete('/profile/{profile}', [ProfileController::class, 'destroyProfile'])->name('profile.destroy-profile');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
