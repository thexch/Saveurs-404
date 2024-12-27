<?php

namespace App\Http\Controllers\Admin;

use App\Models\Reservation;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class GestionReservationController extends Controller
{
    public function index()
    {
        $reservations = Reservation::with('user')->get();
        return view('admin.gestionreservations', compact('reservations'));
    }
}