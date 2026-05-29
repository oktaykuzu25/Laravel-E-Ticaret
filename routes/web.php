<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TestController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ShoppingController;
use App\Http\Controllers\OrderController;


Route::get('/', [HomeController::class, 'home'])->name('home');

// seper işlemleri
Route::get('/sepet', [ShoppingController::class, 'index'])->name('shopping.index');
Route::get('/sepet/ekle/{id}', [ShoppingController::class, 'addtocart'])->name('shopping.addtocart');
Route::get('/sepet/sil/{id}', [ShoppingController::class, 'removefromcart'])->name('shopping.removefromcart');
Route::post('/sepet/guncelle/{rawId}', [ShoppingController::class, 'updatecart'])->name('shopping.updatecart');
Route::get('/sepet/arttir/{rawId}', [ShoppingController::class, 'increase'])->name('shopping.increase');
Route::get('/sepet/azalt/{rawId}', [ShoppingController::class, 'decrease'])->name('shopping.decrease');


// sipariş işlemleri
Route::post('/siparisi-olustur', [OrderController::class, 'store'])->name('order.store');
Route::get('/siparislerim', [OrderController::class, 'index'])->name('order.index');

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
