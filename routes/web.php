<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UsulanAsetController;
use App\Http\Controllers\ApprovalManagerController;
use App\Http\Controllers\ApprovalDirekturController;
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
    Route::get('/approve/{id}', [ApprovalManagerController::class, 'approve'])->name('approve');
    Route::get('/reject/{id}', [ApprovalManagerController::class, 'reject'])->name('reject');
});

// DIREKTUR
Route::prefix('direktur/approval')->name('direktur.approval.')->group(function () {
    Route::get('/', [ApprovalDirekturController::class, 'index'])->name('index');
    Route::get('/approve/{id}', [ApprovalDirekturController::class, 'approve'])->name('approve');
    Route::get('/reject/{id}', [ApprovalDirekturController::class, 'reject'])->name('reject');
});

require __DIR__ . '/auth.php';
