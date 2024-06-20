<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BerandaController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PegawaiController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', function () {
    return view('Login.login-aplikasi');
});

Route::get('/beranda', function () {
    return view('HalamanDepan.beranda');
});

// Pegawai Routes
Route::get('/data-pegawai', [PegawaiController::class, 'index'])->name('data-pegawai');
Route::get('/create-pegawai', [PegawaiController::class, 'create'])->name('create-pegawai');
Route::post('/simpan-pegawai', [PegawaiController::class, 'store'])->name('simpan-pegawai');
Route::get('/edit-pegawai/{id}', [PegawaiController::class, 'edit'])->name('edit-pegawai');
Route::post('/update-pegawai/{id}', [PegawaiController::class, 'update'])->name('update-pegawai');
Route::get('/delete-pegawai/{id}', [PegawaiController::class, 'destroy'])->name('delete-pegawai');

// Tambahkan rute untuk restore dan force delete
Route::put('/pegawai/{id}/restore', [PegawaiController::class, 'restore'])->name('pegawai.restore');
Route::delete('/pegawai/{id}/force-delete', [PegawaiController::class, 'forceDelete'])->name('pegawai.forceDelete');

Route::resource('pegawai', PegawaiController::class);
Route::resource('jabatan', JabatanController::class);

// Login Routes
Route::get('/login', [LoginController::class, 'halamanlogin'])->name('login');
Route::post('/postlogin', [LoginController::class, 'postlogin'])->name('postlogin');
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');
