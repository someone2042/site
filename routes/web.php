<?php

use App\Http\Controllers\categorierController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\SiteController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', [SiteController::class, 'index'])->name('index');

Route::get('/creat', function () {
    return view('creat_site');
})->middleware('auth');

Route::get('/admin', [LoginController::class, 'login'])->name('login');
Route::post('/authentification', [LoginController::class, 'authentification'])->name('authentification');

Route::get('/register', [UserController::class, 'register'])->name('register')->middleware('auth');
Route::post('/store', [UserController::class, 'store'])->name('store')->middleware('auth');
Route::put('/user/update/{id}', [UserController::class, 'update'])->name('update')->middleware('auth');
Route::delete('/user/delete/{id}', [UserController::class, 'delete'])->name('delete')->middleware('auth');

Route::get('/logout', [LoginController::class, 'logout'])->name('logout')->middleware('auth');

Route::get('/create', [SiteController::class, 'site_create'])->name('create')->middleware('auth');
Route::post('/site/store', [SiteController::class, 'store'])->name('site.store')->middleware('auth');
Route::put('/site/update/{id}', [SiteController::class, 'update'])->name('site.update')->middleware('auth');
Route::delete('/site/delete/{id}', [SiteController::class, 'delete'])->name('site.delete')->middleware('auth');

Route::get('/toggle-sidebar', function () {
    $isOpen = session('sidebar_open', false); // Get current state, default is false
    session(['sidebar_open' => !$isOpen]); // Toggle the state
    return redirect()->back(); // Redirect back to the previous page
})->name('toggle-sidebar');

Route::get('/{id}',[SiteController::class,'site'])->name('site');
