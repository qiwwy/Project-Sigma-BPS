<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Interns;
use Illuminate\Support\Str;

class InternsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Interns::create([
            'identity_number' => '11.222.3333',  // Diubah identity_number
            'name' => 'Administrator',  // Diubah nama
            'school_name' => 'BPS Kota Pekalongan',
            'email' => 'bpspkl.go.id',
            'start_date' => '2024-12-15',
            'end_date' => '2024-12-16',
            'status' => 'Nonactive',
            'role' => 'admin'
        ]);
        Interns::create([
            'identity_number' => '11.222.3334',  // Diubah identity_number
            'name' => 'P3SDI',  // Diubah nama
            'school_name' => 'BPS Kota Pekalongan',
            'email' => 'bpspkl.go.id',
            'start_date' => '2024-12-15',
            'end_date' => '2024-12-16',
            'status' => 'Nonactive',
            'role' => 'mentor',
            'division_id' => 1
        ]);
        Interns::create([
            'identity_number' => '11.222.3335',  // Diubah identity_number
            'name' => 'Teknis',  // Diubah nama
            'school_name' => 'BPS Kota Pekalongan',
            'email' => 'bpspkl.go.id',
            'start_date' => '2024-12-15',
            'end_date' => '2024-12-16',
            'status' => 'Nonactive',
            'role' => 'mentor',
            'division_id' => 2
        ]);
        Interns::create([
            'identity_number' => '11.222.3336',  // Diubah identity_number
            'name' => 'Sub Bagian Umum',  // Diubah nama
            'school_name' => 'BPS Kota Pekalongan',
            'email' => 'bpspkl.go.id',
            'start_date' => '2024-12-15',
            'end_date' => '2024-12-16',
            'status' => 'Nonactive',
            'role' => 'mentor',
            'division_id' => 3
        ]);

        $startDateBandung = '2025-01-12';
        $endDateBandung = '2025-02-12';

        $startDatePekalongan = '2025-01-13';
        $endDatePekalongan = '2025-03-13';

        $startDateYogya = '2025-03-05';
        $endDateYogya = '2025-04-05';

        $divisionLimits = [1 => 0, 2 => 0, 3 => 0]; // Counter untuk tiap division_id

        function getDivisionId(&$limits)
        {
            $available = array_filter($limits, fn($count) => $count < 5); // Filter division yang masih tersedia
            $division = array_rand($available); // Ambil division_id secara acak dari yang tersedia
            $limits[$division]++; // Tambahkan count pada division yang dipilih
            return $division;
        }

        $data = [
            [
                'identity_number' => '21.230.4567',
                'name' => 'Muhammad Rando ',
                'school_name' => 'Iwima Kota Pekalongan',
                'start_date' => $startDateBandung,
                'end_date' => $endDateBandung,
            ],
            [
                'identity_number' => '21.230.9876',
                'name' => 'Citra Dewi',
                'school_name' => 'SMK Negeri Bandung Raya',
                'start_date' => $startDateBandung,
                'end_date' => $endDateBandung,
            ],
            [
                'identity_number' => '21.230.1234',
                'name' => 'Dian Puspitasari',
                'school_name' => 'SMK Negeri Bandung Raya',
                'start_date' => $startDateBandung,
                'end_date' => $endDateBandung,
            ],
            [
                'identity_number' => '21.230.4321',
                'name' => 'Dian Indah Nyata',
                'school_name' => 'SMK Negeri Bandung Raya',
                'start_date' => $startDateBandung,
                'end_date' => $endDateBandung,
            ],
            [
                'identity_number' => '21.230.8765',
                'name' => 'Anisa Nuraini',
                'school_name' => 'SMK Negeri Bandung Raya',
                'start_date' => $startDateBandung,
                'end_date' => $endDateBandung,
            ],
            [
                'identity_number' => '21.230.2001',
                'name' => 'Khanifatun',
                'school_name' => 'SMK Negeri Yogyakarta Baru',
                'start_date' => $startDateYogya,
                'end_date' => $endDateYogya,
            ],
            [
                'identity_number' => '21.230.1077',
                'name' => 'Santoso',
                'school_name' => 'SMK Negeri Yogyakarta Baru',
                'start_date' => $startDateYogya,
                'end_date' => $endDateYogya,
            ],
            [
                'identity_number' => '21.230.1088',
                'name' => 'Dewi Yodelling',
                'school_name' => 'SMK Negeri Yogyakarta Baru',
                'start_date' => $startDateYogya,
                'end_date' => $endDateYogya,
            ],
            [
                'identity_number' => '21.230.1099',
                'name' => 'Indriyatmono',
                'school_name' => 'SMK Negeri Yogyakarta Baru',
                'start_date' => $startDateYogya,
                'end_date' => $endDateYogya,
            ],
            [
                'identity_number' => '21.230.1889',
                'name' => 'Nia Kurnia Sari',
                'school_name' => 'SMK Negeri Yogyakarta Baru',
                'start_date' => $startDateYogya,
                'end_date' => $endDateYogya,
            ],
            [
                'identity_number' => '21.230.1001',
                'name' => 'Agus Trihartono',
                'school_name' => 'SMK Negeri Pekalongan Raya',
                'start_date' => $startDatePekalongan,
                'end_date' => $endDatePekalongan,
            ],
            [
                'identity_number' => '21.230.1002',
                'name' => 'Siti Aisyah',
                'school_name' => 'SMK Negeri Pekalongan Raya',
                'start_date' => $startDatePekalongan,
                'end_date' => $endDatePekalongan,
            ],
            [
                'identity_number' => '21.230.1003',
                'name' => 'Rudi Setiawan',
                'school_name' => 'SMK Negeri Pekalongan Raya',
                'start_date' => $startDatePekalongan,
                'end_date' => $endDatePekalongan,
            ],
            [
                'identity_number' => '21.230.1004',
                'name' => 'Fatimah Zahra',
                'school_name' => 'SMK Negeri Pekalongan Raya',
                'start_date' => $startDatePekalongan,
                'end_date' => $endDatePekalongan,
            ],
            [
                'identity_number' => '21.230.1005',
                'name' => 'Ahmad Hidayat',
                'school_name' => 'SMK Negeri Pekalongan Raya',
                'start_date' => $startDatePekalongan,
                'end_date' => $endDatePekalongan,
            ],
        ];

        foreach ($data as $intern) {
            Interns::create([
                'identity_number' => $intern['identity_number'],
                'name' => $intern['name'],
                'school_name' => $intern['school_name'],
                'email' => Str::random(10) . '@example.com', // Email random
                'start_date' => $intern['start_date'],
                'end_date' => $intern['end_date'],
                'role' => 'intern',
                'division_id' => getDivisionId($divisionLimits), // Assign division_id secara acak
            ]);
        }
    }
}
