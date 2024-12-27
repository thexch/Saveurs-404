<?php

namespace Database\Factories;

use App\Models\Reservation;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ReservationFactory extends Factory
{
    protected $model = Reservation::class;

    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'email' => fake()->email(),
            'phone' => fake()->phoneNumber(),
            'date' => fake()->dateTimeBetween('now', '+2 months'),
            'time' => fake()->dateTimeBetween('11:00', '22:00')->format('H:i'),
            'guests' => fake()->numberBetween(1, 8),
            'user_id' => User::factory(),
        ];
    }

    public function past()
    {
        return $this->state(function (array $attributes) {
            return [
                'date' => fake()->dateTimeBetween('-6 months', '-1 day'),
            ];
        });
    }

    public function future()
    {
        return $this->state(function (array $attributes) {
            return [
                'date' => fake()->dateTimeBetween('tomorrow', '+2 months'),
            ];
        });
    }
}