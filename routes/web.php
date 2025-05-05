<?php

use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\Admin\ManageExpertController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ArticlesController;
use Illuminate\Auth\Events\Login;

Route::get('/login', function () {
    return view('login');
})->name('login');
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

Route::get('/admin/login',[LoginController::class, 'showLoginForm']);
Route::post('/admin/login', [LoginController::class, 'postLogin']);

// Route::get('/admin/dashboard', function () {
//     return view('admin.dashboard');
// });

Route::middleware(['auth'])->prefix('admin')->group(function () {
    Route::get('/dashboard', [LoginController::class, 'index'])->name('admin.dashboard');
    
    Route::post('/logout', [LoginController::class, 'logout'])->name('admin.logout');

    Route::get('/manage-expert', [ManageExpertController::class, 'manageExpert'])->name('admin.manage-expert');
    Route::get('/manage-payment', [ManageExpertController::class, 'manageExpert'])->name('admin.manage-payment');
    Route::get('/manage-recap', [ManageExpertController::class, 'manageRecap'])->name('admin.manage-recap');

    Route::get('/experts/{expert}/edit', [ManageExpertController::class, 'edit'])->name('admin.edit-expert');
    Route::put('/experts/{expert}', [ManageExpertController::class, 'update'])->name('admin.update-expert');
    Route::put('/experts/{expert}/status', [ManageExpertController::class, 'updateStatus']);
    Route::delete('/experts/{expert}', [ManageExpertController::class, 'destroy'])->name('admin.delete-expert');
});

