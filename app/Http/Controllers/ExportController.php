<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\StreamedResponse;
use Carbon\Carbon;

class ExportController extends Controller
{
    public function exportUserData(): StreamedResponse
    {
        Carbon::setLocale('fr');
        date_default_timezone_set('Europe/Paris');

        $user = Auth::user();
        $reservations = $user->reservations()->get();

        $userData = [
            'id' => $user->user_id,
            'nom' => $user->name,
            'email' => $user->email,
            'date_inscription' => Carbon::parse($user->created_at)->format('Y-m-d')
        ];

        $reservationsData = $reservations->map(function ($reservation) {
            return [
                'id_reservation' => $reservation->reservation_id,
                'nom' => $reservation->name,
                'telephone' => $reservation->phone,
                'email' => $reservation->email,
                'date' => Carbon::parse($reservation->date)->format('Y-m-d'),
                'heure' => Carbon::parse($reservation->time)->format('H:i'),
                'nombre_personnes' => $reservation->guests,
                'date_creation' => Carbon::parse($reservation->created_at)->format('Y-m-d H:i')
            ];
        })->toArray();

        $filename = 'export_donnees_' . $user->name . '_' . date('Y-m-d') . '.csv';

        return response()->streamDownload(function () use ($userData, $reservationsData) {
            $handle = fopen('php://output', 'w');
            
            // Définir l'encodage UTF-8
            fprintf($handle, chr(0xEF).chr(0xBB).chr(0xBF));
            
            // En-tête du fichier
            fputcsv($handle, ['DONNÉES EXPORTÉES LE ' . date('d/m/Y H:i')], ';');
            fputcsv($handle, [], ';');
            
            // Informations utilisateur
            fputcsv($handle, ['INFORMATIONS UTILISATEUR'], ';');
            foreach ($userData as $key => $value) {
                fputcsv($handle, [$key, $value], ';');
            }
            fputcsv($handle, [], ';');
            
            // Réservations
            if (!empty($reservationsData)) {
                fputcsv($handle, ['RÉSERVATIONS'], ';');
                // En-têtes des colonnes
                fputcsv($handle, array_keys($reservationsData[0]), ';');
                // Données des réservations
                foreach ($reservationsData as $reservation) {
                    fputcsv($handle, $reservation, ';');
                }
            }

            fclose($handle);
        }, $filename);
    }
}