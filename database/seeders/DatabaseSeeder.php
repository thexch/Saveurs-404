<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Avis;
use App\Models\Reservation;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Créer 10 utilisateurs
        User::factory()
            ->count(10)
            ->has(Avis::factory()->count(1))
            ->has(Reservation::factory()->past()->count(1))
            ->has(Reservation::factory()->future()->count(1))
            ->create();

        // Créer un admin
        User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@admin.com',
            'password' => bcrypt('adminadmin'),
            'role' => 'admin',
        ]);
    }
}