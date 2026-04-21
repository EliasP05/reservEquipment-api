<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::create([
            'name' => 'Elias Peralta',
            'email' => 'eliasalberto0505@gmail.com',
            'dni' => 43438715,
            'password' => 'password'
        ]);
        User::create([
            'name' => 'Generico',
            'email' => 'generico@gmail.com',
            'dni' => 12345678,
            'password' => 'password'
        ]);
        $this->call([equipmenetSeed::class]);
    }
}
