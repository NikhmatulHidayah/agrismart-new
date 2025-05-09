<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ArticlesController;
use App\Http\Controllers\OrderMeetController;
use App\Http\Controllers\DashboardFarmerController;



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
    })->name('dashboard');  // Tanpa middleware 'auth'
Route::get('/tanaman', [TanamanController::class, 'index'])->name('tanaman.index');   
Route::get('/ordermeet', [OrderMeetController::class, 'index'])->name('ordermeet.index');  // Tanpa middleware 'auth'
Route::get('/ordermeet/create', [OrderMeetController::class, 'create'])->name('ordermeet.create');  // Tanpa middleware 'auth'
Route::post('/ordermeet/store', [OrderMeetController::class, 'store'])->name('ordermeet.store');  // Tanpa middleware 'auth'
    

// Ahli Tani
Route::get('/ordermeet/manage', [OrderMeetController::class, 'manage'])->name('ordermeet.manage');
Route::post('/ordermeet/confirm/{id}', [OrderMeetController::class, 'confirm'])->name('ordermeet.confirm');


// Ahli Tani Routes
// Route::middleware('auth')->prefix('ahli')->name('ahli.')->group(function () {
//     Route::get('/order-meet', [OrderMeetController::class, 'ahliIndex'])->name('order_meet.index');
//     Route::post('/order-meet/{id}/confirm', [OrderMeetController::class, 'confirm'])->name('order_meet.confirm');
// });
Route::get('/select-role', function () {
    return view('select-role');
});
Route::get('/expert', function () {
    return view('expert.dashboard');
});
Route::get('/expert/articles', function () {
    return view('expert.articles-main');
});
Route::get('/expert/articles/create', function () {
    return view('expert.articles-create');
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
Route::post('login', [AuthController::class, 'postLogin']);
Route::post('register/expert', [AuthController::class, 'postRegisterExpert']);
Route::post('register/farmer', [AuthController::class, 'postRegisterFarmer']);
