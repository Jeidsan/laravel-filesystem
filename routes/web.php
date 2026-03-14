<?php

use App\Http\Controllers\FileController;
use Illuminate\Support\Facades\Route;

Route::get('/', [FileController::class, 'index'])->name('home');

Route::get('/storage-local-create', [FileController::class, 'storageLocalCreate'])->name('storage.local.create');
Route::get('/storage-local-append', [FileController::class, 'storageLocalAppend'])->name('storage.local.append');
Route::get('/storage-local-read', [FileController::class, 'storageLocalRead'])->name('storage.local.read');
Route::get('/storage-local-read-multi', [FileController::class, 'storageLocalReadMulti'])->name('storage.local.read.multi');
Route::get('/storage-local-check-file', [FileController::class, 'storageLocalCheckFile'])->name('storage.local.check.file');
Route::get('/storage-local-store-json', [FileController::class, 'storeJson'])->name('storage.local.store.json');
Route::get('/storage-local-read-json', [FileController::class, 'readJson'])->name('storage.local.read.json');
Route::get('/storage-local-list-files', [FileController::class, 'listFiles'])->name('storage.local.list.files');
Route::get('/storage-local-delete', [FileController::class, 'deleteFile'])->name('storage.local.delete');
Route::get('/storage-local-create-folder', [FileController::class, 'createFolder'])->name('storage.local.create.folder');
Route::get('/storage-local-delete-folder', [FileController::class, 'deleteFolder'])->name('storage.local.delete.folder');
Route::get('/storage-local-list-file-metadata', [FileController::class, 'listFilesWithMetadata'])->name('storage.local.list.files.metadata');
Route::get('/storage-local-list-for-download', [FileController::class, 'listFilesForDownload'])->name('storage.local.list.files.download');
Route::get('/download/{file}', [FileController::class, 'download'])->name('storage.local.download');
Route::post('/storage-local-upload', [FileController::class, 'upload'])->name('storage.local.upload');
