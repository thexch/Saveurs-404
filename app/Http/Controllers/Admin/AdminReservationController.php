<?php

namespace App\Http\Controllers\Admin;

use App\Models\Reservation;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminReservationController extends Controller
{
    public function index()
    {
        $reservations = Reservation::with('user')->get();
        return view('admin.gestionreservations', compact('reservations'));
    }

    public function edit($id)
    {
        $reservation = Reservation::findOrFail($id);
        return view('admin.editreservation', compact('reservation'));
    }

    public function update(Request $request, $id)
{
    $reservation = Reservation::findOrFail($id);

    $validated = $request->validate([
        'name' => 'required',
        'email' => 'required|email',
        'phone' => 'required',
        'date' => 'required|date',
        'time' => 'required',
        'guests' => 'required|integer|min:1'
    ]);

    $reservation->update($validated);

    return response()->json([
        'success' => true,
        'message' => 'Réservation modifiée avec succès'
    ]);
}

    public function destroy($id)
    {
        $reservation = Reservation::findOrFail($id);
        $reservation->delete();

        return redirect()->route('admin.gestionreservations')
            ->with('success', 'Réservation supprimée avec succès.');
    }
}