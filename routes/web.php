<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MikrotikController;
use Illuminate\Support\Facades\Artisan;

// ✅ ROUTE NORMAL
Route::resource('mikrotik', MikrotikController::class);
Route::get('/mikrotik/test/{id}', [MikrotikController::class, 'test'])->name('mikrotik.test');


Route::get('/dashboard', function () {
    return view('pages.dashboard');
});

// ⚠️ ROUTE MIGRASI SEMENTARA (hapus setelah sukses)
Route::get('/run-migrate', function () {
    Artisan::call('migrate');
    return 'Migrasi berhasil dijalankan!';
});
