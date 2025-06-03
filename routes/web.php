<?php

use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\Admin\ManageExpertController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ArticlesController;
use Illuminate\Auth\Events\Login;
use App\Http\Controllers\OrderMeetController;
use App\Http\Controllers\DashboardFarmerController;
use App\Http\Controllers\DataTanamanController;
use App\Http\Controllers\HamaController;
use App\Http\Controllers\PemupukanController;
use App\Http\Controllers\KonsultasiController;
use App\Http\Controllers\DataAhliTaniController;
use App\Http\Controllers\ExpertKonsultasiController;
use App\Http\Controllers\RatingController;
use App\Http\Controllers\farmerController;



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

Route::get('login/farmer/dashboard', [farmerController::class, 'dashboard'])->name('dashboard.farmer');
Route::get('/article/{id}', [farmerController::class, 'show'])->name('articles.show');


Route::resource('tanaman', DataTanamanController::class); 
Route::get('/hama', [HamaController::class, 'index'])->name('hama.index');
Route::get('/pemupukan', [PemupukanController::class, 'index'])->name('pemupukan.index');
Route::get('/ordermeet', [OrderMeetController::class, 'index'])->name('ordermeet.index');  // Tanpa middleware 'auth'
Route::get('/ordermeet/create', [OrderMeetController::class, 'create'])->name('ordermeet.create');  // Tanpa middleware 'auth'
Route::post('/ordermeet/store', [OrderMeetController::class, 'store'])->name('ordermeet.store');  // Tanpa middleware 'auth'
Route::post('/ordermeet/process-payment', [OrderMeetController::class, 'processPayment'])->name('ordermeet.process_payment');
Route::get('/ordermeet/payment-success', [OrderMeetController::class, 'paymentSuccess'])->name('ordermeet.payment_success');
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

Route::get('/expert', [DataAhliTaniController::class, 'dashboard'])->middleware('auth')->name('expert.dashboard');


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

Route::get('/expert/articles', [ArticlesController::class, 'index']);
Route::get('/expert/articles/create', [ArticlesController::class, 'create']);
Route::get('/expert/articles/{id}', [ArticlesController::class, 'show']);
Route::post('/expert/articles/create/post', [ArticlesController::class, 'postCreateArticle']);

Route::get('/register/expert', [AuthController::class, 'getRegisterExpert']);
Route::post('/register/expert/post', [AuthController::class, 'PostRegisterExpert']);

Route::get('/register/farmer', [AuthController::class, 'getRegisterfarmer']);
Route::post('/register/farmer/post', [AuthController::class, 'PostRegisterfarmer']);

Route::get('/admin/login',[LoginController::class, 'showLoginForm']);
Route::post('/admin/login', [LoginController::class, 'postLogin']);

// Route::get('/admin/dashboard', function () {
//     return view('admin.dashboard');
// });

Route::middleware(['auth'])->prefix('admin')->group(function () {
    Route::get('/dashboard', [LoginController::class, 'index'])->name('admin.dashboard');
    
    Route::post('/logout', [LoginController::class, 'logout'])->name('admin.logout');

    Route::get('/manage-expert', [ManageExpertController::class, 'manageExpert'])->name('admin.manage-expert');
    Route::get('/manage-payment', [ManageExpertController::class, 'managePayment'])->name('admin.manage-payment');
    Route::get('/manage-recap', [ManageExpertController::class, 'manageRecap'])->name('admin.manage-recap');

    Route::get('/experts/{expert}/edit', [ManageExpertController::class, 'edit'])->name('admin.edit-expert');
    Route::put('/experts/{expert}', [ManageExpertController::class, 'update'])->name('admin.update-expert');
    Route::put('/experts/{expert}/status', [ManageExpertController::class, 'updateStatus']);
    Route::delete('/experts/{expert}', [ManageExpertController::class, 'destroy'])->name('admin.delete-expert');
});

Route::get('/logout', [AuthController::class, 'logout'])->name('process.logout');


Route::get('/konsultasi', [KonsultasiController::class, 'index'])->name('konsultasi.index');
Route::middleware('auth')->group(function () {
    Route::get('/konsultasi/ahli_tani/{id}', [KonsultasiController::class, 'pilihAhliTani'])->name('konsultasi.pilihAhliTani');
    Route::get('/pembayaran/{id}', [KonsultasiController::class, 'pembayaran'])->name('pembayaran');
    Route::post('/proses-pembayaran', [KonsultasiController::class, 'prosesPembayaran'])->name('proses_pembayaran');
    Route::get('/konsultasi/saya', [KonsultasiController::class, 'farmerConsultations'])->name('konsultasi.farmer_consultations');
    Route::get('/konsultasi/saya/{id}', [KonsultasiController::class, 'showFarmerConsultationDetail'])->name('konsultasi.farmer_detail');
});
Route::get('/pembayaran-sukses/{id_ahli_tani}/{amount}', function ($id_ahli_tani, $amount) {
    return view('konsultasi.pembayaran_sukses', compact('id_ahli_tani', 'amount'));
})->name('pembayaran_sukses');
Route::get('/isi-konsultasi', [KonsultasiController::class, 'formKonsultasi'])->name('isi_konsultasi');
Route::post('/isi-konsultasi', [KonsultasiController::class, 'submitKonsultasi'])->name('submit_konsultasi');
Route::get('/konsultasi-sukses', [KonsultasiController::class, 'konsultasiSukses'])->name('konsultasi_sukses');

Route::middleware('auth')->prefix('expert')->name('expert.')->group(function () {
    Route::get('/profile', [DataAhliTaniController::class, 'index'])->name('profile.index');
    Route::get('/profile/create', [DataAhliTaniController::class, 'create'])->name('profile.create');
    Route::post('/profile', [DataAhliTaniController::class, 'store'])->name('profile.store');
    Route::get('/konsultasi', [ExpertKonsultasiController::class, 'index'])->name('konsultasi.index');
    Route::get('/konsultasi/{id}', [ExpertKonsultasiController::class, 'show'])->name('konsultasi.show');
    Route::put('/konsultasi/{id}/answer', [ExpertKonsultasiController::class, 'submitAnswer'])->name('konsultasi.submitAnswer');
});


Route::post('/ordermeet/{id}/done', [OrderMeetController::class, 'markAsDone'])->name('ordermeet.done');
Route::post('/rating/store', [RatingController::class, 'store'])->name('rating.store');
