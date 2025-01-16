<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Avis;
use App\Models\Reservation;
use Illuminate\Support\Facades\DB; 


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

        // Création de tables
        DB::table('tables')->insert([
            ['table_id' => 1, 'nb_sieges' => 2],
            ['table_id' => 2, 'nb_sieges' => 4],
            ['table_id' => 3, 'nb_sieges' => 6],
            ['table_id' => 4, 'nb_sieges' => 8],
        ]);
    }
}