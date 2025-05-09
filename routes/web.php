<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\DataTanamanController;
use App\Http\Controllers\HamaController;
use App\Http\Controllers\PemupukanController;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ArticlesController;



Route::get('/login', function () {
    return view('login');
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

Route::get('/select-role', function () {
    return view('select-role');
});

Route::get('/expert', function () {
    return view('expert.dashboard');
});


Route::post('/login/post', [AuthController::class, 'postLogin']);

Route::get('/register/expert', [AuthController::class, 'getRegisterExpert']);
Route::post('/register/expert/post', [AuthController::class, 'PostRegisterExpert']);

Route::get('/register/farmer', [AuthController::class, 'getRegisterfarmer']);
Route::post('/register/farmer/post', [AuthController::class, 'PostRegisterfarmer']);

Route::fallback(function () {
    return redirect('/login');
});

Route::get('/expert/articles', [ArticlesController::class, 'index']);
Route::get('/expert/articles/create', [ArticlesController::class, 'create']);
Route::get('/expert/articles/{id}', [ArticlesController::class, 'show']);
Route::post('/expert/articles/create/post', [ArticlesController::class, 'postCreateArticle']);