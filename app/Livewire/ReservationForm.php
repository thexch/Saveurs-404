<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Reservation;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;

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
                'user_id' => Auth::id(),
            ]);

            session()->flash('message', 'Reservation successfully created.');

            $this->reset();
        });
    }

    public function getAvailableTimes()
    {
        $times = [];
        $start = Carbon::createFromTime(12, 0);
        $end = Carbon::createFromTime(14, 0);
        $interval = 15;

        while ($start <= $end) {
            $times[] = $start->format('H:i');
            $start->addMinutes($interval);
        }

        $start = Carbon::createFromTime(19, 0);
        $end = Carbon::createFromTime(22, 0);

        while ($start <= $end) {
            $times[] = $start->format('H:i');
            $start->addMinutes($interval);
        }

        if ($this->date == Carbon::today()->format('Y-m-d')) {
            $times = array_filter($times, function ($time) {
                return Carbon::createFromFormat('H:i', $time)->greaterThanOrEqualTo(Carbon::now());
            });
        }

        return $times;
    }

    public function render()
    {
        return view('livewire.reservation-form', [
            'availableTimes' => $this->getAvailableTimes(),
        ]);
    }
}