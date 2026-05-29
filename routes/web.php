<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TestController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\HomeController;


Route::get('/', [HomeController::class, 'home'])->name('home');

Route::prefix('admin')->middleware('admin')->group(function () {
    Route::get('/deneme', [TestController::class, 'test'])->name('test');
    Route::get('/detail', [TestController::class, 'detail'])->name('detail');

    Route::get('/kitaplar', [BookController::class, 'index'])->name('books.index');
    Route::get('/kitaplar/ekle', [BookController::class, 'create'])->name('books.create');
    Route::post('/kitaplar/ekle', [BookController::class, 'store'])->name('books.store');


    Route::get('/kitaplar/{id}', [BookController::class, 'edit'])->name('books.edit');
    Route::put('/kitaplar/{id}', [BookController::class, 'update'])->name('books.update');
    Route::delete('/kitaplar/{id}', [BookController::class, 'destroy'])->name('books.destroy');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
