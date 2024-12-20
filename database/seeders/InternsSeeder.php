<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Interns;

class InternsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $startDateBandung = '2024-10-25';
        $endDateBandung = '2024-12-25';
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
        Interns::create([
            'identity_number' => '21.230.0187',  // Diubah identity_number
            'name' => 'Muhammad Bagus Setiawan',  // Diubah nama
            'school_name' => 'Iwima Kota Pekalongan',
            'email' => 'sbm@gmail.com',
            'start_date' => $startDateBandung,
            'end_date' => $endDateBandung,
            'role' => 'intern'
        ]);
        Interns::create([
            'identity_number' => '21.230.1003',
            'name' => 'Citra Dewi',
            'school_name' => 'SMK Negeri Bandung Raya',
            'email' => 'citra@example.com',
            'start_date' => $startDateBandung,
            'end_date' => $endDateBandung,
            'role' => 'intern'
        ]);
        Interns::create([
            'identity_number' => '21.230.1004',
            'name' => 'Dian Puspitasari',
            'school_name' => 'SMK Negeri Bandung Raya',
            'email' => 'dian@example.com',
            'start_date' => $startDateBandung,
            'end_date' => $endDateBandung,
            'role' => 'intern'
        ]);
        Interns::create([
            'identity_number' => '21.230.1050',
            'name' => 'Dian Indah Nyata',
            'school_name' => 'SMK Negeri Bandung Raya',
            'email' => 'dian@example.com',
            'start_date' => $startDateBandung,
            'end_date' => $endDateBandung,
            'role' => 'intern'
        ]);
        Interns::create([
            'identity_number' => '21.230.0971',
            'name' => 'Anisa Nuraini',
            'school_name' => 'SMK Negeri Bandung Raya',
            'email' => 'dian@example.com',
            'start_date' => $startDateBandung,
            'end_date' => $endDateBandung,
            'role' => 'intern'
        ]);

        $startDateYogya = '2024-11-20';
        $endDateYogya = '2025-01-20';
        Interns::create([
            'identity_number' => '21.230.2001',
            'name' => 'Khanifatun',
            'school_name' => 'SMK Negeri Yogyakarta Baru',  // Diubah nama sekolah
            'email' => 'asep_yogya@example.com',
            'start_date' => $startDateYogya,
            'end_date' => $endDateYogya,
            'role' => 'intern'
        ]);
        Interns::create([
            'identity_number' => '21.230.1077',
            'name' => 'Santoso',
            'school_name' => 'SMK Negeri Yogyakarta Baru',
            'email' => 'budi_yogya@example.com',
            'start_date' => $startDateYogya,
            'end_date' => $endDateYogya,
            'role' => 'intern'
        ]);
        Interns::create([
            'identity_number' => '21.230.1088',
            'name' => 'Dewi Yodelling',
            'school_name' => 'SMK Negeri Yogyakarta Baru',
            'email' => 'citra_yogya@example.com',
            'start_date' => $startDateYogya,
            'end_date' => $endDateYogya,
            'role' => 'intern',
        ]);
        Interns::create([
            'identity_number' => '21.230.1099',
            'name' => 'Indriyatmono',
            'school_name' => 'SMK Negeri Yogyakarta Baru',
            'email' => 'dian_yogya@example.com',
            'start_date' => $startDateYogya,
            'end_date' => $endDateYogya,
            'role' => 'intern'
        ]);
        Interns::create([
            'identity_number' => '21.230.1889',
            'name' => 'Nia Kurnia Sari',
            'school_name' => 'SMK Negeri Yogyakarta Baru',
            'email' => 'dian_yogya@example.com',
            'start_date' => $startDateYogya,
            'end_date' => $endDateYogya,
            'role' => 'intern'
        ]);

        $startDateSurabaya = '2025-01-01';
        $endDateSurabaya = '2025-03-05';
        Interns::create([
            'identity_number' => '21.230.1200',
            'name' => 'Bagas Praskoro',
            'school_name' => 'SMK Negeri Surabaya Baru',  // Diubah nama sekolah
            'email' => 'asep_surabaya@example.com',
            'start_date' => $startDateSurabaya,
            'end_date' => $endDateSurabaya,
            'status' => 'Nonactive',
            'role' => 'intern'
        ]);
        Interns::create([
            'identity_number' => '21.230.1311',
            'name' => 'Vira Thaud',
            'phone_number' => '085150021010',
            'email' => 'budi_surabaya@example.com',
            'start_date' => $startDateSurabaya,
            'end_date' => $endDateSurabaya,
            'status' => 'Nonactive',
            'role' => 'intern'
        ]);
        Interns::create([
            'identity_number' => '21.230.1912',
            'name' => 'Jones Iskandar',
            'school_name' => 'SMK Negeri Surabaya Baru',
            'email' => 'citra_surabaya@example.com',
            'start_date' => $startDateSurabaya,
            'end_date' => $endDateSurabaya,
            'status' => 'Nonactive',
            'role' => 'intern'
        ]);
        Interns::create([
            'identity_number' => '21.230.1413',
            'name' => 'Baris Situmorang',
            'school_name' => 'SMK Negeri Surabaya Baru',
            'email' => 'dian_surabaya@example.com',
            'start_date' => $startDateSurabaya,
            'end_date' => $endDateSurabaya,
            'status' => 'Nonactive',
            'role' => 'intern'
        ]);
        Interns::create([
            'identity_number' => '21.230.2347',
            'name' => 'Fida Zulhida',
            'school_name' => 'SMK Negeri Surabaya Baru',
            'email' => 'vika_surabaya@example.com',
            'start_date' => $startDateSurabaya,
            'end_date' => $endDateSurabaya,
            'status' => 'Nonactive',
            'role' => 'intern'
        ]);
    }
}
