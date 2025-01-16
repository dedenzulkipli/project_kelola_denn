<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ReportKegiatanController;
use App\Http\Controllers\ReportKegiatanDetailController;

Route::get('/', function () {
    return redirect()->route('report-kegiatan.index');
});

// Routes untuk Report Kegiatan
Route::get('/report-kegiatan', [ReportKegiatanController::class, 'index'])->name('report-kegiatan.index');
Route::get('/report-kegiatan/create', [ReportKegiatanController::class, 'create'])->name('report-kegiatan.create');
Route::post('/report-kegiatan/store', [ReportKegiatanController::class, 'store'])->name('report-kegiatan.store');
Route::get('report-kegiatan/{id}/edit', [ReportKegiatanController::class, 'edit'])->name('report-kegiatan.edit');
Route::put('report-kegiatan/{id}', [ReportKegiatanController::class, 'update'])->name('report-kegiatan.update');
Route::delete('/report-kegiatan/{id}', [ReportKegiatanController::class, 'destroy'])->name('report-kegiatan.destroy');
Route::get('/search', [ReportKegiatanController::class, 'search'])->name('report-kegiatan.search');

Route::get('/report-kegiatan/{id}/add-detail', [ReportKegiatanController::class, 'addDetail'])->name('report-kegiatan.add-detail');
Route::post('/report-kegiatan/{id}/store-detail', [ReportKegiatanController::class, 'storeDetail'])->name('report-kegiatan.store-detail');

// Route untuk Detail Berdasarkan ID Report
Route::get('/report-kegiatan/{id}/details', [ReportKegiatanController::class, 'showDetails'])->name('report-kegiatan.show-details');

Route::get('report-kegiatan/details/{id}/edit', [ReportKegiatanDetailController::class, 'edit'])->name('report-kegiatan.details.edit');
Route::put('report-kegiatan/details/{id}', [ReportKegiatanDetailController::class, 'update'])->name('report-kegiatan.details.update');
Route::delete('report-kegiatan/details/{id}', [ReportKegiatanDetailController::class, 'destroy'])->name('report-kegiatan.details.destroy');
Route::get('/report-kegiatan/{id}/export-excel', [ReportKegiatanController::class, 'exportExcel'])->name('report-kegiatan.export-excel');
