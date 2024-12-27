<?php

namespace App\Livewire;

use Livewire\Component;
use App\Livewire\Actions\Logout;

class LogoutButton extends Component
{
    public function logout()
    {
        // Création d'une instance de Logout et appel direct
        $logout = new Logout();
        $logout();
        
        return redirect()->route('home');
    }

    public function render()
    {
        return view('livewire.logout-button');
    }
}