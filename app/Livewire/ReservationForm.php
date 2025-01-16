<?php


namespace App\Livewire;

use Livewire\Component;
use App\Models\Reservation;
use App\Models\Table;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class ReservationForm extends Component
{
    public $name;
    public $email;
    public $phone;
    public $date;
    public $time;
    public $guests;
    public $table_ids = [];

    protected $rules = [
        'name' => 'required|string|max:255',
        'email' => 'required|email|max:255',
        'phone' => 'required|string|max:20',
        'date' => 'required|date',
        'time' => 'required|date_format:H:i',
        'guests' => 'required|integer|min:1',
        'table_ids' => 'required|array|min:1',
        'table_ids.*' => 'exists:tables,table_id',
    ];

    public function submit()
    {
        DB::transaction(function () {
            $this->validate();

            $reservation = Reservation::create([
                'name' => $this->name,
                'email' => $this->email,
                'phone' => $this->phone,
                'date' => $this->date,
                'time' => $this->time,
                'guests' => $this->guests,
                'user_id' => Auth::id(),
            ]);

            // Attacher les tables sélectionnées à la réservation
            $reservation->tables()->attach($this->table_ids);

            session()->flash('success', 'Votre réservation a été confirmée.');

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

    public function getAvailableTables()
{
    $tables = Table::all();
    $filteredTables = [];
    $exactMatchFound = false;
    $closestTable = null;

    foreach ($tables as $table) {
        if ($table->nb_sieges == $this->guests) {
            $filteredTables[] = ['table' => $table, 'recommended' => true];
            $exactMatchFound = true;
        } elseif ($table->nb_sieges > $this->guests) {
            if ($closestTable === null || $table->nb_sieges < $closestTable->nb_sieges) {
                $closestTable = $table;
            }
        }
    }

    if (!$exactMatchFound && $closestTable !== null) {
        array_unshift($filteredTables, ['table' => $closestTable, 'recommended' => true]); 
    }

    
    foreach ($tables as $table) {
        if (!in_array(['table' => $table, 'recommended' => true], $filteredTables)) {
            $filteredTables[] = ['table' => $table, 'recommended' => false];
        }
    }

    return $filteredTables;
}

    public function render()
    {
        return view('livewire.reservation-form', [
            'availableTimes' => $this->getAvailableTimes(),
            'availableTables' => $this->getAvailableTables(), // Utiliser les tables filtrées
        ]);
    }
}