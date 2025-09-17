<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SuratController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\PageController;



Route::get('/', [SuratController::class,'index'])->name('surat.index');

Route::resource('surat', SuratController::class)->except(['index']);
Route::get('surat-download/{id}', [SuratController::class,'download'])->name('surat.download');

Route::resource('kategori', KategoriController::class)->except(['show']);

Route::get('about', [PageController::class,'about'])->name('about');
