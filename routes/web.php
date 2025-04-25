<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\AvisController;
use App\Http\Controllers\ExportController; 
use App\Http\Controllers\Admin\GestionReservationController;
use App\Http\Controllers\Admin\GestionUserController;
use App\Http\Controllers\Admin\AdminReservationController;



Route::get('/home', [HomeController::class, 'index'])
    ->name('home');

Route::redirect('/', '/home');

Route::view('reserver', 'reserver')
    ->middleware(['auth', 'verified'])
    ->name('reserver');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

Route::get('/reservations', [ReservationController::class, 'index'])
    ->name('reservations');

Route::delete('/reservations/{id}', [ReservationController::class, 'destroy'])
    ->name('reservations.destroy');

Route::post('/avis', [AvisController::class, 'store'])
    ->name('avis.store');
    
Route::get('/export-user-data', [ExportController::class, 'exportUserData'])
    ->middleware('auth')
    ->name('export.user');    

Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
        // Route pour la liste des réservations
        Route::get('/gestionreservations', [GestionReservationController::class, 'index'])
            ->name('gestionreservations');
        
        // Route pour la gestion des utilisateurs    
        Route::get('/gestionusers', [GestionUserController::class, 'index'])
            ->name('gestionusers');
        
        // Routes pour les réservations admin
        Route::get('/reservations/edit/{id}', [AdminReservationController::class, 'edit'])
            ->name('editreservation');
        
        Route::put('/reservations/{id}', [AdminReservationController::class, 'update'])
            ->name('updatereservation');
        
        Route::delete('/reservations/{id}', [AdminReservationController::class, 'destroy'])
            ->name('deletereservation');
        
        Route::put('/users/{id}', [GestionUserController::class, 'update'])
            ->name('updateuser');
        
        Route::delete('/users/{id}', [GestionUserController::class, 'destroy'])
            ->name('deleteuser');
        
});

require __DIR__.'/auth.php';