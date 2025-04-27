<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ArticlesController;


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

