<?php 

use App\Http\Controllers\PDFController;

Route::get('/', [PDFController::class, 'showUploadForm'])->name('uploadForm');
Route::post('/upload', [PDFController::class, 'uploadPDF'])->name('uploadPDF');
Route::get('/pdfs', [PDFController::class, 'listPDFs'])->name('listPDFs');
Route::get('/pdf/{id}', [PDFController::class, 'viewPDF'])->name('viewPDF');