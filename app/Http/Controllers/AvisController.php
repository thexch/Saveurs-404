<?php

namespace App\Http\Controllers;

use App\Models\Avis;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AvisController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'note' => 'required|integer|min:1|max:5',
            'commentaire' => 'required|string|max:1000',
        ]);

        // Ajouter la date et l'user_id aux données validées
        $validated['date'] = now()->toDateString();
        $validated['user_id'] = Auth::id();

        Avis::create($validated);

    }
}