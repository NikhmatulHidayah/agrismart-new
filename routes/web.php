<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DataTanamanController;
use App\Http\Controllers\HamaController;
use App\Http\Controllers\PemupukanController;

Route::get('/', function () {
    return view('welcome');
});

Route::resource('tanaman', DataTanamanController::class);
//         return redirect()->route('tanaman.index')->with('success', 'Data tanaman berhasil ditambahkan!');

Route::get('/dashboard', function () {
    return view('dashboard');
});

Route::get('/hama', [HamaController::class, 'index'])->name('hama.index');
Route::post('/hama', [HamaController::class, 'search'])->name('hama.search');


Route::get('/pemupukan', [PemupukanController::class, 'index'])->name('pemupukan.index');
Route::post('/pemupukan', [PemupukanController::class, 'search'])->name('pemupukan.search');
Route::get('/pupuk', [PemupukanController::class, 'index']);