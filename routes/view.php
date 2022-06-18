<?php

use Illuminate\Support\Facades\Route;

Route::get('/preguntas-frecuentes', function () {
    return view('contacto.preguntas');
})->name('contacto.preguntas');

Route::get('/contacto', function () {
    return view('contacto.formulario');
})->name('contacto.formulario');

Route::post('/contacto', function () {
    
})->name('contacto.form_enviado');

Route::get('/politica-de-cookies', function () {
    return view('legal.cookies');
})->name('legal.cookies');

Route::get('/aviso-legal', function () {
    return view('legal.aviso');
})->name('legal.aviso');

Route::get('/politica-de-privacidad', function () {
    return view('legal.privacidad');
})->name('legal.privacidad');