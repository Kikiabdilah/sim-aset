<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UsulanAsetController;
use App\Http\Controllers\ApprovalManagerController;
use App\Http\Controllers\ApprovalDirekturController;
use App\Http\Controllers\AsetController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MaintenanceController;
use App\Http\Controllers\PenghapusanController;
use App\Http\Controllers\LaporanController;

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('login');
});

// Semua halaman yang butuh login
Route::middleware('auth')->group(function () {

    // DASHBOARD
    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('dashboard');

    // PROFILE
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::delete('/profile/delete-photo', [ProfileController::class, 'deletePhoto'])
        ->name('profile.delete-photo');

    // ADMIN
    Route::prefix('admin/usulan')->name('admin.usulan.')->group(function () {
        Route::get('/create', [UsulanAsetController::class, 'create'])->name('create');
        Route::post('/store', [UsulanAsetController::class, 'store'])->name('store');
    });

    // MANAGER
    Route::prefix('manager/approval')->name('manager.approval.')->group(function () {
        Route::get('/', [ApprovalManagerController::class, 'index'])->name('index');
        Route::post('/approve/{id}', [ApprovalManagerController::class, 'approve'])->name('approve');
        Route::post('/reject/{id}', [ApprovalManagerController::class, 'reject'])->name('reject');
    });

    // DIREKTUR
    Route::prefix('direktur')->name('direktur.')->group(function () {
        Route::get('/approval', [ApprovalDirekturController::class, 'index'])->name('approval.index');
        Route::post('/approval/{id}/approve', [ApprovalDirekturController::class, 'approve'])
            ->name('approval.approve');
        Route::post('/approval/{id}/reject', [ApprovalDirekturController::class, 'reject'])
            ->name('approval.reject');
    });

    // ASET
    Route::get('/aset', [AsetController::class, 'index'])->name('aset.index');

    // PEMELIHARAAN ASET
    Route::prefix('maintenance')->name('maintenance.')->middleware('auth')->group(function () {
        Route::get('/', [MaintenanceController::class, 'index'])->name('index');
        Route::get('/{id}', [MaintenanceController::class, 'show'])->name('show');
        Route::get('/{id}/create', [MaintenanceController::class, 'create'])->name('create');
        Route::post('/{id}/store', [MaintenanceController::class, 'store'])->name('store');
    });


    // // REKOMENDASI PENGHAPUSAN
    // Route::prefix('hapus')->name('hapus.')->group(function () {
    //     Route::get('/', [PenghapusanController::class, 'index'])->name('index');
    //     Route::post('/store', [PenghapusanController::class, 'store'])->name('store');
    // });

    // // LAPORAN
    // Route::prefix('laporan')->name('laporan.')->group(function () {
    //     Route::get('/', [LaporanController::class, 'index'])->name('index');
    //     Route::get('/aset', [LaporanController::class, 'laporanAset'])->name('aset');
    //     Route::get('/penghapusan', [LaporanController::class, 'laporanPenghapusan'])->name('penghapusan');
    //     Route::get('/maintenance', [LaporanController::class, 'laporanMaintenance'])->name('maintenance');
    // });
});

require __DIR__ . '/auth.php';
