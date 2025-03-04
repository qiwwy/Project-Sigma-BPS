<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            DivisionSeeder::class,
            SchoolSeeder::class,
            InternsSeeder::class,
            UserSeeder::class,
            InternRegisterSeeder::class,
            LogbookSeeder::class,
            PresenceSeeder::class
        ]);
    }
}
