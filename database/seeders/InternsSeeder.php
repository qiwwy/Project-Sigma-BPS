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
        // $startDateBandung = '2024-10-25';
        // $endDateBandung = '2024-12-25';
        // $lastDateIdBR = '2024-10-15';

        Interns::create([
            'identity_number' => '11.222.3333',  // Diubah identity_number
            'name' => 'Administrator',  // Diubah nama
            'address' => 'Jl. Singosari, Podosugih, Kec. Pekalongan Bar., Kota Pekalongan, Jawa Tengah 51111',
            'school_name' => 'BPS Kota Pekalongan',
            'phone_number' => '085150021000',
            'email' => 'bpspkl.go.id',
            'start_date' => '2024-12-15',
            'end_date' => '2024-12-16',
            'image' => 'admin.jpg',
            'role' => 'admin'
        ]);
        Interns::create([
            'identity_number' => '21.230.0187',  // Diubah identity_number
            'name' => 'Muhammad Bagus Setiawan',  // Diubah nama
            'address' => 'Desa. Samborejo',
            'school_name' => 'Iwima Kota Pekalongan',
            'phone_number' => '08150021000',
            'email' => 'sbm@gmail.com',
            'start_date' => '2024-12-15',
            'end_date' => '2025-01-15',
            'image' => 'bagus.jpg',
            'role' => 'intern'
        ]);
        // Interns::create([
        //     'mentor_id' => null,
        //     'identity_number' => '21.230.1003',
        //     'name' => 'Citra Dewi',
        //     'address' => 'Bandung',
        //     'school_name' => 'SMK Negeri Bandung Raya',
        //     'phone_number' => '085150021003',
        //     'email' => 'citra@example.com',
        //     'start_date' => $startDateBandung,
        //     'end_date' => $endDateBandung,
        //     'image' => 'foto3.jpg',
        //     'role' => 'intern'
        // ]);
        // Interns::create([
        //     'mentor_id' => null,
        //     'identity_number' => '21.230.1004',
        //     'name' => 'Dian Puspitasari',
        //     'address' => 'Bandung',
        //     'school_name' => 'SMK Negeri Bandung Raya',
        //     'phone_number' => '085150021004',
        //     'email' => 'dian@example.com',
        //     'start_date' => $startDateBandung,
        //     'end_date' => $endDateBandung,
        //     'image' => 'foto4.jpg',
        //     'role' => 'intern'
        // ]);
        // Interns::create([
        //     'mentor_id' => null,
        //     'identity_number' => '21.230.1050',
        //     'name' => 'Dian Indah Nyata',
        //     'address' => 'Bandung',
        //     'school_name' => 'SMK Negeri Bandung Raya',
        //     'phone_number' => '085150021004',
        //     'email' => 'dian@example.com',
        //     'start_date' => $startDateBandung,
        //     'end_date' => $endDateBandung,
        //     'image' => 'foto5.jpg',
        //     'role' => 'intern'
        // ]);

        // $startDateYogya = '2024-11-20';
        // $endDateYogya = '2025-01-20';
        // $lastDateIdYB = '2024-11-18';

        // Interns::create([
        //     'mentor_id' => null,
        //     'identity_number' => '21.230.1006',
        //     'name' => 'Rahmat',
        //     'address' => 'Yogyakarta',
        //     'school_name' => 'SMK Negeri Yogyakarta Baru',  // Diubah nama sekolah
        //     'phone_number' => '085150021005',
        //     'email' => 'asep_yogya@example.com',
        //     'start_date' => $startDateYogya,
        //     'end_date' => $endDateYogya,
        //     'image' => 'foto6.jpg',
        //     'role' => 'intern'
        // ]);
        // Interns::create([
        //     'mentor_id' => null,
        //     'identity_number' => '21.230.1007',
        //     'name' => 'Santoso',
        //     'address' => 'Yogyakarta',
        //     'school_name' => 'SMK Negeri Yogyakarta Baru',
        //     'phone_number' => '085150021006',
        //     'email' => 'budi_yogya@example.com',
        //     'start_date' => $startDateYogya,
        //     'end_date' => $endDateYogya,
        //     'image' => 'foto7.jpg',
        //     'role' => 'intern'
        // ]);
        // Interns::create([
        //     'mentor_id' => null,
        //     'identity_number' => '21.230.1008',
        //     'name' => 'Dewi',
        //     'address' => 'Yogyakarta',
        //     'school_name' => 'SMK Negeri Yogyakarta Baru',
        //     'phone_number' => '085150021007',
        //     'email' => 'citra_yogya@example.com',
        //     'start_date' => $startDateYogya,
        //     'end_date' => $endDateYogya,
        //     'image' => 'foto8.jpg',
        //     'role' => 'intern',
        //     'role' => 'intern'
        // ]);
        // Interns::create([
        //     'mentor_id' => null,
        //     'identity_number' => '21.230.1009',
        //     'name' => 'Indri',
        //     'address' => 'Yogyakarta',
        //     'school_name' => 'SMK Negeri Yogyakarta Baru',
        //     'phone_number' => '085150021008',
        //     'email' => 'dian_yogya@example.com',
        //     'start_date' => $startDateYogya,
        //     'end_date' => $endDateYogya,
        //     'image' => 'foto9.jpg',
        //     'role' => 'intern'
        // ]);
        // Interns::create([
        //     'mentor_id' => null,
        //     'identity_number' => '21.230.1809',
        //     'name' => 'Nia Kurnia Sari',
        //     'address' => 'Yogyakarta',
        //     'school_name' => 'SMK Negeri Yogyakarta Baru',
        //     'phone_number' => '085150021008',
        //     'email' => 'dian_yogya@example.com',
        //     'start_date' => $startDateYogya,
        //     'end_date' => $endDateYogya,
        //     'image' => 'foto9.jpg',
        //     'role' => 'intern'
        // ]);

        // $startDateSurabaya = '2025-01-01';
        // $endDateSurabaya = '2025-03-05';
        // $lastDateIdSB = '2024-12-25';

        // Interns::create([
        //     'mentor_id' => null,
        //     'identity_number' => '21.230.1010',
        //     'name' => 'Bagus',
        //     'address' => 'Surabaya',
        //     'school_name' => 'SMK Negeri Surabaya Baru',  // Diubah nama sekolah
        //     'phone_number' => '085150021009',
        //     'email' => 'asep_surabaya@example.com',
        //     'start_date' => $startDateSurabaya,
        //     'end_date' => $endDateSurabaya,
        //     'image' => 'foto10.jpg',
        //     'role' => 'intern'
        // ]);
        // Interns::create([
        //     'mentor_id' => null,
        //     'identity_number' => '21.230.1011',
        //     'name' => 'Vira',
        //     'address' => 'Surabaya',
        //     'school_name' => 'SMK Negeri Surabaya Baru',
        //     'phone_number' => '085150021010',
        //     'email' => 'budi_surabaya@example.com',
        //     'start_date' => $startDateSurabaya,
        //     'end_date' => $endDateSurabaya,
        //     'image' => 'foto11.jpg',
        //     'role' => 'intern'
        // ]);
        // Interns::create([
        //     'mentor_id' => null,
        //     'identity_number' => '21.230.1012',
        //     'name' => 'Jones',
        //     'address' => 'Surabaya',
        //     'school_name' => 'SMK Negeri Surabaya Baru',
        //     'phone_number' => '085150021011',
        //     'email' => 'citra_surabaya@example.com',
        //     'start_date' => $startDateSurabaya,
        //     'end_date' => $endDateSurabaya,
        //     'image' => 'foto12.jpg',
        //     'role' => 'intern'
        // ]);
        // Interns::create([
        //     'mentor_id' => null,
        //     'identity_number' => '21.230.1013',
        //     'name' => 'Baris',
        //     'address' => 'Surabaya',
        //     'school_name' => 'SMK Negeri Surabaya Baru',
        //     'phone_number' => '085150021012',
        //     'email' => 'dian_surabaya@example.com',
        //     'start_date' => $startDateSurabaya,
        //     'end_date' => $endDateSurabaya,
        //     'image' => 'foto13.jpg',
        //     'role' => 'intern'
        // ]);
        // Interns::create([
        //     'mentor_id' => null,
        //     'identity_number' => '21.230.2347',
        //     'name' => 'Fida',
        //     'address' => 'Surabaya',
        //     'school_name' => 'SMK Negeri Surabaya Baru',
        //     'phone_number' => '085150021012',
        //     'email' => 'vika_surabaya@example.com',
        //     'start_date' => $startDateSurabaya,
        //     'end_date' => $endDateSurabaya,
        //     'image' => 'foto14.jpg',
        //     'role' => 'intern'
        // ]);
    }
}
