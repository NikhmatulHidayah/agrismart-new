<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ArticlesController;
use App\Http\Controllers\OrderMeetController;
use App\Http\Controllers\DashboardFarmerController;
use App\Http\Controllers\DataTanamanController;
use App\Http\Controllers\HamaController;
use App\Http\Controllers\PemupukanController;
use App\Http\Controllers\KonsultasiController;
use App\Http\Controllers\DataAhliTaniController;

Route::get('/login', function () {
    return view('login');
})->name('login');


// Petani Routes
// Route::middleware('auth')->prefix('petani')->name('petani.')->group(function () {
//     Route::get('/order-meet', [OrderMeetController::class, 'petaniIndex'])->name('order_meet.index');
//     Route::get('/order-meet/create', [OrderMeetController::class, 'create'])->name('order_meet.create');
//     Route::post('/order-meet', [OrderMeetController::class, 'store'])->name('order_meet.store');
// });


// // ----------------- PETANI -----------------
// Route::prefix('farmer')->group(function () {
//     Route::get('/dashboard', [DashboardFarmerController::class, 'index'])->middleware('auth');
//     Route::get('/order-meet', [OrderMeetController::class, 'petaniIndex'])->name('order_meet.index');
//     Route::get('/order-meet/create', [OrderMeetController::class, 'create'])->name('order_meet.create');
//     Route::post('/order-meet', [OrderMeetController::class, 'store'])->name('order_meet.store');
// });z

// // ----------------- AHLI TANI -----------------
// Route::get('/ahliTani/dashboard-ahli', [AhliOrderMeetController::class, 'dashboard'])->name('ahli.dashboard');
// Route::post('/ahliTani/confirm-order/{id}', [AhliOrderMeetController::class, 'confirmOrder'])->name('ahli.confirmOrder');
// Route::post('/ahliTani/finish-order/{id}', [AhliOrderMeetController::class, 'finishOrder'])->name('ahli.finishOrder');

    // Petani
    Route::get('login/farmer/dashboard', function () {
        return view('dashboard'); // Pastikan kamu memiliki view dashboard.blade.php
    })->name('dashboard.farmer');  // Tanpa middleware 'auth'
Route::resource('tanaman', DataTanamanController::class); 
Route::get('/hama', [HamaController::class, 'index'])->name('hama.index');
Route::get('/pemupukan', [PemupukanController::class, 'index'])->name('pemupukan.index');
Route::get('/ordermeet', [OrderMeetController::class, 'index'])->name('ordermeet.index');  // Tanpa middleware 'auth'
Route::get('/ordermeet/create', [OrderMeetController::class, 'create'])->name('ordermeet.create');  // Tanpa middleware 'auth'
Route::post('/ordermeet/store', [OrderMeetController::class, 'store'])->name('ordermeet.store');  // Tanpa middleware 'auth'
    //article
Route::get('/expert/articles', [ArticlesController::class, 'index']);
Route::get('/expert/articles/create', [ArticlesController::class, 'create']);
Route::post('/expert/articles/create/post', [ArticlesController::class, 'postCreateArticle']);
Route::get('/expert/articles/{id}', [ArticlesController::class, 'show']);


// Ahli Tani
Route::get('expert/ordermeet/manage', [OrderMeetController::class, 'manage'])->name('ordermeet.manage');
Route::post('expert/ordermeet/confirm/{id}', [OrderMeetController::class, 'confirm'])->name('ordermeet.confirm');


// Ahli Tani Routes
// Route::middleware('auth')->prefix('ahli')->name('ahli.')->group(function () {
//     Route::get('/order-meet', [OrderMeetController::class, 'ahliIndex'])->name('order_meet.index');
//     Route::post('/order-meet/{id}/confirm', [OrderMeetController::class, 'confirm'])->name('order_meet.confirm');
// });
Route::get('/select-role', function () {
    return view('select-role');
});

Route::get('/expert', function () {
    return view('expert.dashboard-expert');
});


// Route::post('/login/post', [AuthController::class, 'postLogin']);
// Route::post('/expert/articles/create/post', [ArticlesController::class, 'postCreateArticle']);

// Route::get('/register/expert', [AuthController::class, 'getRegisterExpert']);
// Route::post('/register/expert/post', [AuthController::class, 'PostRegisterExpert']);

// Route::get('/register/farmer', [AuthController::class, 'getRegisterfarmer']);
// Route::post('/register/farmer/post', [AuthController::class, 'PostRegisterfarmer']);
Route::get('register/expert', [AuthController::class, 'getRegisterExpert']);
Route::get('register/expert', [AuthController::class, 'getRegisterExpert'])->name('register.expert');
Route::post('register/expert/post', [AuthController::class, 'postRegisterExpert'])->name('register.expert.post');
Route::get('login/expert', [AuthController::class, 'getLoginExpert']);
Route::get('register/farmer', [AuthController::class, 'getRegisterFarmer']);
Route::get('login/farmer', [AuthController::class, 'getLoginFarmer']);
Route::post('login', [AuthController::class, 'postLogin'])->name('process_login');
Route::post('register/expert', [AuthController::class, 'postRegisterExpert']);
Route::post('register/farmer', [AuthController::class, 'postRegisterFarmer'])->name('register.farmer');

Route::fallback(function () {
    return redirect('/login');
});


Route::get('/logout', [AuthController::class, 'logout'])->name('process.logout');

Route::get('/konsultasi', [KonsultasiController::class, 'index'])->name('konsultasi.index');
Route::middleware('auth')->group(function () {
    Route::get('/konsultasi/ahli_tani/{id}', [KonsultasiController::class, 'pilihAhliTani'])->name('konsultasi.pilihAhliTani');
    Route::get('/pembayaran/{id}', [KonsultasiController::class, 'pembayaran'])->name('pembayaran');
    Route::post('/proses-pembayaran', [KonsultasiController::class, 'prosesPembayaran'])->name('proses_pembayaran');
});
Route::get('/pembayaran-sukses', function () {
    return view('konsultasi.pembayaran_sukses');
})->name('pembayaran_sukses');
Route::get('/isi-konsultasi', [KonsultasiController::class, 'formKonsultasi'])->name('isi_konsultasi');
Route::post('/isi-konsultasi', [KonsultasiController::class, 'submitKonsultasi'])->name('submit_konsultasi');
Route::get('/konsultasi-sukses', [KonsultasiController::class, 'konsultasiSukses'])->name('konsultasi_sukses');

Route::middleware('auth')->prefix('expert')->name('expert.')->group(function () {
    Route::get('/profile', [DataAhliTaniController::class, 'index'])->name('profile.index');
    Route::get('/profile/create', [DataAhliTaniController::class, 'create'])->name('profile.create');
    Route::post('/profile', [DataAhliTaniController::class, 'store'])->name('profile.store');
    Route::get('/profile/edit', [DataAhliTaniController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [DataAhliTaniController::class, 'update'])->name('profile.update');
});