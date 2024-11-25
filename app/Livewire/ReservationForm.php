<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Reservation;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class ReservationForm extends Component
{
    public $name;
    public $email;
    public $phone;
    public $date;
    public $time;
    public $guests;

    protected $rules = [
        'name' => 'required|string|max:255',
        'email' => 'required|email|max:255',
        'phone' => 'required|string|max:20',
        'date' => 'required|date',
        'time' => 'required|date_format:H:i',
        'guests' => 'required|integer|min:1',
    ];

    public function submit()
    {
        DB::transaction(function () {
            $this->validate();

            Reservation::create([
                'name' => $this->name,
                'email' => $this->email,
                'phone' => $this->phone,
                'date' => $this->date,
                'time' => $this->time,
                'guests' => $this->guests,
                'user_id' => Auth::id(), // Ajout de l'ID de l'utilisateur connecté
            ]);

            session()->flash('message', 'Reservation successfully created.');

            $this->reset();
        });
    }

    public function render()
    {
        return view('livewire.reservation-form');
    }
}