<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProfileController;

Route::middleware('auth')->group(function () {
    Route::get('/', [MenuController::class, 'redirect']);
    Route::get('/menu', [MenuController::class, 'getMenu'])->name('dashboard');
    Route::get('/pesanan', [OrderController::class, 'getPesanan'])->name('pesanan');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::post('/checkout', [OrderController::class, 'store'])->name('checkout');
    Route::post('/pesanan/batalkan', [OrderController::class, 'batalkanPesanan'])->name('user.pesanan.batalkan');
    Route::get('/pesanan/rincian', [OrderController::class, 'rincianPesanan'])->name('rincian');
});

Route::middleware('auth')->group(function () {
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::get('/admin/pesanan/rincian', [AdminController::class, 'rincianPesanan'])->name('rincian.admin');
    Route::get('/admin/products', [AdminController::class, 'getProducts'])->name('admin.products');
    Route::post('admin/pesanan/batalkan', [AdminController::class, 'batalkanPesanan'])->name('admin.pesanan.batalkan');
    Route::post('admin/pesanan/proses', [AdminController::class, 'prosesPesanan'])->name('admin.pesanan.proses');
    Route::post('admin/pesanan/selesai', [AdminController::class, 'selesaiPesanan'])->name('admin.pesanan.selesai');
    Route::post('admin/pesanan/hapus', [AdminController::class, 'hapusPesanan'])->name('admin.pesanan.hapus');
    Route::post('admin/menu/hapus', [AdminController::class, 'hapusMenu'])->name('admin.menu.hapus');
    Route::get('admin/menu/edit', [AdminController::class, 'viewEditMenu'])->name('admin.menu.edit');
    Route::post('admin/menu/editMenu', [AdminController::class, 'editMenu'])->name('admin.edit.menu');
    Route::post('admin/pesanan/hapus', [AdminController::class, 'hapusPesanan'])->name('admin.pesanan.hapus');
    Route::get('admin/manu/tambah', [AdminController::class, 'viewTambahMenu'])->name('admin.viewTambah.products');
    Route::post('admin/manu/tambahMenu', [AdminController::class, 'tambahMenu'])->name('admin.tambah.products');
    Route::get('/admin/profile', [ProfileController::class, 'editAdmin'])->name('profile.edit.admin');    
});


require __DIR__.'/auth.php';
