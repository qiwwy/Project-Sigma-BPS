<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'username' => 'admin',
            'password' => '$2y$12$.kYf6xSQHi2v3v8AAwooDOsQ67DqLFMzuGq5EfOBfr1PcWX536uiS',
            'interns_id' => 1
        ]);
        User::create([
            'username' => 'p3sdi',
            'password' => '$2y$12$kAqHbc1.QhYbLAiwIhAUdOywDwM/AXfIKQg3jjw4OE9hg9t69lFWq',
            'interns_id' => 2
        ]);
        User::create([
            'username' => 'teknis',
            'password' => '$2y$12$po7oyT9LMGFz5R95SxSubu./1wdbTB25uq3pSEmGSCdbY/HhVZ47S',
            'interns_id' => 3
        ]);
        User::create([
            'username' => 'umum',
            'password' => '$2y$12$oLSiZtLCSqo.ruBeVGVYKOxHQy3Hi.JJarCTmRFcnGdDtIwBIcWI6',
            'interns_id' => 4
        ]);
    }
}
