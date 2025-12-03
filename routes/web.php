<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PelangganController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\AuthController;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/pcr', function () {
    return 'Selamat Datang di Website Kampus PCR!';
});

Route::get('/mahasiswa/{param1}', [MahasiswaController::class, 'show'])->name('mahasiswa.show');


Route::get('/nama/{param1?}/{nim?}', function ($param1= '', $nim= '') {
    return 'Nama saya: '.$param1. '<br> nim : '.$nim;
});

Route::get('/about', function () {
    return view('halaman-about');
});

Route::get('/home', [HomeController::class, 'index'])->name ('home');

Route::post('question/store', [QuestionController::class, 'store'])
    ->name('question.store');

Route::resource('pelanggan', PelangganController::class);

route::group(['middleware' => ['checkrole::Super Admin']], function () {
Route::resource('user', UserController::class);
});


Route::resource('products', ProductsController::class);

     route::get('pelanggan',[PelangganController::class,'index'])->name('pelanggan.index')->middleware('checkislogin');





     //route login
    route::get('auth',[AuthController::class,'index'])->name('auth');
    route::post('auth/login',[AuthController::class,'login'])->name('auth.login');
route::get('auth/logout',[AuthController::class,'logout'])->name('auth.logout');


