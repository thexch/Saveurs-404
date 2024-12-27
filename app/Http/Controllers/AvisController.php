<?php

namespace App\Http\Controllers;

use App\Models\Avis;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AvisController extends Controller
{
    public function store(Request $request)
    {
        $existingAvis = Avis::where('user_id', Auth::id())->first();
        if ($existingAvis) {
            return back()->with('error', 'Vous avez déjà laissé un avis.');
        }
        
        $validated = $request->validate([
            'note' => 'required|integer|min:1|max:5',
            'commentaire' => 'required|string|max:1000',
        ]);

        // Ajouter la date et l'user_id aux données validées
        $validated['date'] = now()->toDateString();
        $validated['user_id'] = Auth::id();

        Avis::create($validated);

        return back()->with('success', 'Merci d\'avoir donné votre avis !');

    }
}