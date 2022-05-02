<?php

use App\Http\Controllers\MensajeController;
use App\Http\Controllers\PisoController;
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
Route::resource('mensaje', MensajeController::class);

Route::get('search/places', 'SearchController@places')->name('search.places');
