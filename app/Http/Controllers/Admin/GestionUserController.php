<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;


class GestionUserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('admin.gestionusers', compact('users'));
    }
    public function update(Request $request, $id)
{
    try {
        $user = User::findOrFail($id);
        
        $validated = $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'role' => 'required|in:user,admin'
        ]);
        
        $user->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Utilisateur modifié avec succès'
        ]);
    } catch (\Exception $e) {
        return response()->json([
            'success' => false,
            'message' => $e->getMessage()
        ], 500);
    }
}
    public function destroy($id)
{
    $user = User::findOrFail($id);
    
    // Empêcher la suppression de son propre compte
    if ($user->id === auth()->id()) {
        return redirect()->back()->with('error', 'Vous ne pouvez pas supprimer votre propre compte.');
    }

    $user->delete();
    return redirect()->route('admin.gestionusers')
        ->with('success', 'Utilisateur supprimé avec succès');
}
}