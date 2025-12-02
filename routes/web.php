<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\RambuController;
use App\Http\Controllers\ExportController;
use App\Http\Controllers\UserController;
use App\Models\Rambu;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ActivityLogController;

// Redirect root
Route::get('/', function () {
    return Auth::check() ? redirect('/dashboard') : redirect('/login');
});

// === GUEST (belum login) ===
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
});

// Logout
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// === YANG SUDAH LOGIN (auth) ===
Route::middleware('auth')->group(function () {

    // DASHBOARD (hanya 1 kali!)
    Route::get('/dashboard', function () {
        $total    = Rambu::count();
        $baik     = Rambu::where('kondisi', 'Baik')->count();
        $rusak    = Rambu::where('kondisi', 'Rusak')->count();
        $perlu    = Rambu::where('kondisi', 'Perlu Perbaikan')->count();
        $gpsCount = Rambu::whereNotNull('koordinat_gps')->count();
        $terbaru  = Rambu::latest()->take(5)->get();

        return view('dashboard', compact('total', 'baik', 'rusak', 'perlu', 'gpsCount', 'terbaru'));
    })->name('dashboard');

    // === FITUR RAMBU (Petugas + Admin) ===
    Route::resource('rambu', RambuController::class);
    Route::get('/peta', [RambuController::class, 'peta'])->name('rambu.peta');

    // === EXPORT (Petugas + Admin) ===
    Route::get('/export/excel', [ExportController::class, 'excel'])->name('export.excel');
    Route::get('/export/pdf',   [ExportController::class, 'pdf'])  ->name('export.pdf');

    // === KHUSUS ADMIN SAJA ===
    Route::middleware('role:admin')->prefix('admin')->group(function () {
        Route::resource('users', UserController::class)->except(['show']);

        Route::get('/rambu/deleted', [RambuController::class, 'deleted'])->name('rambu.deleted');

        // Laporan khusus admin (jika berbeda dari export biasa)
        Route::get('/laporan/pdf',   [ExportController::class, 'pdf'])  ->name('laporan.pdf');
        Route::get('/laporan/excel', [ExportController::class, 'excel'])->name('laporan.excel');
    });

    // Restore Data
    Route::post('/rambu/{id}/restore', [RambuController::class, 'restore'])->name('rambu.restore');
});

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/logs', [ActivityLogController::class, 'index'])->name('logs.index');
});

Route::delete('/rambu/{id}/permanent', [RambuController::class, 'forceDelete'])
     ->name('rambu.forceDelete')
     ->middleware(['auth', 'role:admin']);