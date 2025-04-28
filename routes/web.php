<?php

use App\Http\Controllers\ExpertiseController;
use Illuminate\Support\Facades\Route;

// Route untuk halaman utama
Route::get('/', function () {
    return view('welcome');
});

// Route untuk fitur expertises
Route::prefix('expertises')->group(function () {
    Route::get('/', [ExpertiseController::class, 'index'])->name('expertises.index');
    Route::get('/create', [ExpertiseController::class, 'create'])->name('expertises.create');
    Route::post('/', [ExpertiseController::class, 'store'])->name('expertises.store');
    Route::get('/{dataAhliTani}/edit', [ExpertiseController::class, 'edit'])->name('expertises.edit');
    Route::put('/{dataAhliTani}', [ExpertiseController::class, 'update'])->name('expertises.update');
    Route::delete('/{dataAhliTani}', [ExpertiseController::class, 'destroy'])->name('expertises.destroy');
});




