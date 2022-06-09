<?php

use App\Http\Controllers\DireccionController;
use App\Http\Controllers\FilterController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\MensajeController;
use App\Http\Controllers\PisoController;
use App\Http\Controllers\UserController;
use App\Http\Livewire\Busqueda\Autosearch;
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

Route::get('/', function () {
    return view('index');
})->name('index');

Route::resource('pisos', PisoController::class);

Route::put('direcciones/{direccion}', [DireccionController::class,'update'])->middleware('auth')->name('direcciones.update');
Route::get('direcciones/{direccion}/edit', [DireccionController::class,'edit'])->middleware('auth')->name('direcciones.edit');

Route::get('filter', [FilterController::class, 'index'])->name('filter.index');
Route::get('busqueda', [FilterController::class, 'search'])->name('filter.search');

Route::get('busqueda/{ciudad}', [FilterController::class, 'searchedCities'])->name('filter.searched');

Route::resource('mensajes', MensajeController::class)->middleware('auth');
Route::resource('perfil', UserController::class)->middleware('auth');

// RUTAS LIVEWIRE
Route::get('buscar', Autosearch::class);

// Route::get('/login',[LoginController::class,'create'])->name('login.create');
// Route::post('/login',[LoginController::class,'store'])->name('login.store');
Route::get('/logout',[LoginController::class,'destroy'])->name('login.destroy');

require __DIR__.'/auth.php';
require __DIR__.'/view.php';