<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::middleware('auth')->group(function() {
    Route::get('/cabinet', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::get('/category', [App\Http\Controllers\Admin\GetAllPagesController::class, 'category'])->name('category');
    Route::get('/product', [App\Http\Controllers\Admin\GetAllPagesController::class, 'article'])->name('product');
    Route::get('/', [App\Http\Controllers\Admin\GetAllPagesController::class, 'admin'])->name('admin');
});

Auth::routes();
