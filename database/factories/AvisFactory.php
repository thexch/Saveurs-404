<?php

namespace Database\Factories;

use App\Models\Avis;
use Illuminate\Database\Eloquent\Factories\Factory;

class AvisFactory extends Factory
{
    protected $model = Avis::class;

    public function definition(): array
    {
        return [
            'note' => fake()->numberBetween(0, 5),
            'commentaire' => fake()->paragraph(),
            'date' => fake()->dateTimeBetween('-1 year', 'now'),
            'user_id' => \App\Models\User::factory(),
        ];
    }
}