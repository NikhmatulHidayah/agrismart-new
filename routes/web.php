<?php

use App\Http\Controllers\ExpertiseController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ArticlesController;

<<<<<<< HEAD
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



=======

Route::get('/login', function () {
    return view('login');
});
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

Route::post('/login/post', [AuthController::class, 'postLogin']);
Route::post('/expert/articles/create/post', [ArticlesController::class, 'postCreateArticle']);

Route::get('/register/expert', [AuthController::class, 'getRegisterExpert']);
Route::post('/register/expert/post', [AuthController::class, 'PostRegisterExpert']);

Route::get('/register/farmer', [AuthController::class, 'getRegisterfarmer']);
Route::post('/register/farmer/post', [AuthController::class, 'PostRegisterfarmer']);
>>>>>>> 3e7c7c7200c720daf33d8ba909c2b8e9c13584ce

