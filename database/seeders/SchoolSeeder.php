<?php

namespace Database\Seeders;

use App\Models\School;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SchoolSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        School::create([
            'school_name' => 'Iwima Kota Pekalongan',
            'type_school' => 'perguruan_tinggi'
        ]);
        School::create([
            'school_name' => 'Universitas Pekalongan',
            'type_school' => 'perguruan_tinggi'
        ]);
        School::create([
            'school_name' => 'SMK Negri 2 Kota Pekalongan',
            'type_school' => 'perguruan_tinggi'
        ]);
        School::create([
            'school_name' => 'SMK Prima Kota Pekalongan',
            'type_school' => 'perguruan_tinggi'
        ]);
    }
}
