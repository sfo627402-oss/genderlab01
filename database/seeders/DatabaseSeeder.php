<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Species;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Users
        User::factory()->create([
            'name' => 'Admin User',
            'email' => 'admin@admin.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);

        User::factory()->create([
            'name' => 'Biologist User',
            'email' => 'biologist@admin.com',
            'password' => Hash::make('password'),
            'role' => 'biologist',
        ]);

        User::factory()->create([
            'name' => 'Client Breeder',
            'email' => 'client@client.com',
            'password' => Hash::make('password'),
            'role' => 'client',
        ]);

        // Species
        $species = [
            ['name' => 'Ara ararauna', 'family' => 'Psittaculidae', 'description' => 'Blue-and-yellow macaw', 'primer_set' => 'AMORCE-PSITT-A1', 'is_local' => false],
            ['name' => 'Agapornis roseicollis', 'family' => 'Psittaculidae', 'description' => 'Rosy-faced lovebird', 'primer_set' => 'AMORCE-PSITT-A2', 'is_local' => false],
            ['name' => 'Nymphicus hollandicus', 'family' => 'Cacatuidae', 'description' => 'Cockatiel', 'primer_set' => 'AMORCE-CACAT-C1', 'is_local' => false],
            ['name' => 'Psittacus erithacus', 'family' => 'Psittacidae', 'description' => 'African grey parrot', 'primer_set' => 'AMORCE-PSITT-B1', 'is_local' => false],
        ];

        foreach ($species as $sp) {
            Species::create($sp);
        }
    }
}
