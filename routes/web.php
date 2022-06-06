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

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::resource('pisos', PisoController::class);
Route::get('direcciones/{direcciones}/edit', [DireccionController::class,'edit'])->name('direccion.edit');

Route::get('filter', [FilterController::class, 'index'])->name('filter.index');
// Route::get('busqueda', [FilterController::class, 'search'])->name('filter.search');

Route::get('busqueda/{ciudad}', [FilterController::class, 'searchedCities'])->name('filter.searched');
// Route::get('busqueda/{ciudad}/filter', [FilterController::class, 'filterCity'])->name('filter.ciudad');

// Route::get('madrid', [FilterController::class, 'searchMadrid'])->name('search.madrid');
// Route::get('madrid/filter', [FilterController::class, 'filterCity'])->name('filter.ciudad');

Route::resource('mensajes', MensajeController::class);
Route::resource('perfil', UserController::class)->middleware('auth');

// RUTAS LIVEWIRE
Route::get('buscar', Autosearch::class);

// Route::get('/login',[LoginController::class,'create'])->name('login.create');
// Route::post('/login',[LoginController::class,'store'])->name('login.store');
Route::get('/logout',[LoginController::class,'destroy'])->name('login.destroy');

require __DIR__.'/auth.php';