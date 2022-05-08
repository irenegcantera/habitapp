<?php

use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\FilterController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\MensajeController;
use App\Http\Controllers\PisoController;
use App\Http\Controllers\UserController;
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
Route::resource('filter', FilterController::class);
Route::resource('mensajes', MensajeController::class);
Route::resource('perfil', UserController::class);

// Route::get('/login',[LoginController::class,'create'])->name('login.create');
// Route::post('/login',[LoginController::class,'store'])->name('login.store');
Route::get('/logout',[LoginController::class,'destroy'])->name('login.destroy');

// Route::get('search/places', 'SearchController@places')->name('search.places');

require __DIR__.'/auth.php';