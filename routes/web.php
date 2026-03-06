<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KelasController;


Route::get('/', function () {
    return view('welcome');
});
Route::middleware(['web'])->group(function () {
    Route::resource('kelas', KelasController::class)
        ->parameters(['kelas' => 'kelas']);
});

// Tambahkan route untuk bulk delete
Route::delete('/kelas', [KelasController::class, 'bulkDelete'])->name('kelas.bulk-delete');
