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

Route::get('/', [App\Http\Controllers\HomeController::class, 'index']);

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/transaccion', [App\Http\Controllers\TransaccionController::class, 'transaccion'])->name('transaccion');
Route::get('/estado', [App\Http\Controllers\TransaccionController::class, 'estado'])->name('estado');
Route::post('/enviado', [App\Http\Controllers\TransaccionController::class, 'enviado'])->name('enviado');
Route::get('/crearc', [App\Http\Controllers\TransaccionController::class, 'crearc'])->name('crearc');
Route::post('/guardarc', [App\Http\Controllers\TransaccionController::class, 'guardarc'])->name('guardarc');

Route::get('/crearu', [App\Http\Controllers\TransaccionController::class, 'crearu'])->name('crearu');
Route::post('/guardaru', [App\Http\Controllers\TransaccionController::class, 'guardaru'])->name('guardaru');

