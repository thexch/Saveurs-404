<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Reservation;
use Carbon\Carbon;

class ReservationController extends Controller
{
    public function index()
    {
        $userId = Auth::id();
        $today = Carbon::today();

        $upcomingReservations = Reservation::where('user_id', $userId)
            ->where('date', '>=', $today)
            ->orderBy('date', 'asc')
            ->get();

        $pastReservations = Reservation::where('user_id', $userId)
            ->where('date', '<', $today)
            ->orderBy('date', 'desc')
            ->get();

        return view('reservations', compact('upcomingReservations', 'pastReservations'));
    }

    public function destroy($id)
    {
        $reservation = Reservation::findOrFail($id);
        $reservation->delete();

        return redirect()->route('reservations')->with('success', 'Réservation supprimée avec succès.');
    }
}