<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UsulanAsetController;
use App\Http\Controllers\ApprovalManagerController;
use App\Http\Controllers\ApprovalDirekturController;
use App\Http\Controllers\AsetController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::delete('/profile/delete-photo', [ProfileController::class, 'deletePhoto'])
        ->name('profile.delete-photo');
});

// ADMIN
Route::prefix('admin/usulan')->name('admin.usulan.')->group(function () {
    // Route::get('/', [UsulanAsetController::class, 'index'])->name('index');
    Route::get('/create', [UsulanAsetController::class, 'create'])->name('create');
    Route::post('/store', [UsulanAsetController::class, 'store'])->name('store');
});

// MANAGER
Route::prefix('manager/approval')->name('manager.approval.')->group(function () {
    Route::get('/', [ApprovalManagerController::class, 'index'])->name('index');
    Route::post('/approve/{id}', [ApprovalManagerController::class, 'approve'])->name('approve');
    Route::post('/reject/{id}', [ApprovalManagerController::class, 'reject'])->name('reject');
});

// Halaman Direktur
Route::prefix('direktur')->name('direktur.')->group(function () {

    Route::get('/approval', [\App\Http\Controllers\ApprovalDirekturController::class, 'index'])
        ->name('approval.index');

    Route::post('/approval/{id}/approve', [\App\Http\Controllers\ApprovalDirekturController::class, 'approve'])
        ->name('approval.approve');

    Route::post('/approval/{id}/reject', [\App\Http\Controllers\ApprovalDirekturController::class, 'reject'])
        ->name('approval.reject');
});

require __DIR__ . '/auth.php';

Route::get('/aset', [AsetController::class, 'index'])->name('aset.index');
