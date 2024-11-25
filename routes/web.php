<?php

use Illuminate\Support\Facades\Route;

Route::view('/', 'home')
    ->middleware(['auth']); // Ajout du middleware d'authentification

Route::view('caca', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

Route::view('reservations', 'reservations')
    ->middleware(['auth'])
    ->name('reservations');

Route::view('home', 'home')
    ->middleware(['auth'])
    ->name('home');



// Route::view('/resto', 'livewire.resto');

require __DIR__.'/auth.php';
