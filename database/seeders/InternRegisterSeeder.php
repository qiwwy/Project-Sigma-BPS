<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\InternRegister;

class InternRegisterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $startDateBandung = '2025-01-01';
        $endDateBandung = '2025-02-01';

        $startDateYogya = '2025-02-13';
        $endDateYogya = '2025-03-13';

        InternRegister::create([
            'identity_number' => '21.230.0202',
            'name' => 'Asep Rahmat Indahyana',
            'school_id' => 1,
            'email' => 'asep@example.com',
            'start_date' => $startDateBandung,
            'end_date' => $endDateBandung,
            'cover_letter' => 'surat1.docx',
            'token' => 'aseptoken123',
        ]);
        InternRegister::create([
            'identity_number' => '21.230.0203',
            'name' => 'Budi Kurnia',
            'school_id' => 1,
            'email' => 'budi@example.com',
            'start_date' => $startDateBandung,
            'end_date' => $endDateBandung,
            'cover_letter' => 'surat2.docx',
            'token' => 'buditoken456',
        ]);
        InternRegister::create([
            'identity_number' => '21.230.0204',
            'name' => 'Citra Dewi Santika',
            'school_id' => 3,
            'email' => 'citra@example.com',
            'start_date' => $startDateYogya,
            'end_date' => $endDateYogya,
            'cover_letter' => 'surat3.docx',
            'token' => 'citratoken789',
        ]);
        InternRegister::create([
            'identity_number' => '21.230.0205',
            'name' => 'Dian Kartika',
            'school_id' => 3,
            'email' => 'dian@example.com',
            'start_date' => $startDateYogya,
            'end_date' => $endDateYogya,
            'cover_letter' => 'surat4.docx',
            'token' => 'diantoken101',
        ]);

        // InternRegister::create([
        //     'identity_number' => '21.230.0206',
        //     'name' => 'Arsal',
        //     'address' => 'Yogyakarta',
        //     'school_name' => 'SMK Negeri Yogyakarta',
        //     'phone_number' => '085150021005',
        //     'email' => 'asep_yogya@example.com',
        //     'start_date' => $startDateYogya,
        //     'end_date' => $endDateYogya,
        //     'cover_letter' => 'surat5.docx',
        //     'token' => 'asep_yogytoken123',
        //     'image' => 'foto5.jpg',
        // ]);
        // InternRegister::create([
        //     'identity_number' => '21.230.0207',
        //     'name' => 'Bagus',
        //     'address' => 'Yogyakarta',
        //     'school_name' => 'SMK Negeri Yogyakarta',
        //     'phone_number' => '085150021006',
        //     'email' => 'budi_yogya@example.com',
        //     'start_date' => $startDateYogya,
        //     'end_date' => $endDateYogya,
        //     'cover_letter' => 'surat6.docx',
        //     'token' => 'budiyogytoken456',
        //     'image' => 'foto6.jpg',
        // ]);
        // InternRegister::create([
        //     'identity_number' => '21.230.0208',
        //     'name' => 'Yayuk',
        //     'address' => 'Yogyakarta',
        //     'school_name' => 'SMK Negeri Yogyakarta',
        //     'phone_number' => '085150021007',
        //     'email' => 'citra_yogya@example.com',
        //     'start_date' => $startDateYogya,
        //     'end_date' => $endDateYogya,
        //     'cover_letter' => 'surat7.docx',
        //     'token' => 'citratoken789',
        //     'image' => 'foto7.jpg',
        // ]);
        // InternRegister::create([
        //     'identity_number' => '21.230.0209',
        //     'name' => 'Iwan',
        //     'address' => 'Yogyakarta',
        //     'school_name' => 'SMK Negeri Yogyakarta',
        //     'phone_number' => '085150021008',
        //     'email' => 'dian_yogya@example.com',
        //     'start_date' => $startDateYogya,
        //     'end_date' => $endDateYogya,
        //     'cover_letter' => 'surat8.docx',
        //     'token' => 'diantoken102',
        //     'image' => 'foto8.jpg',
        // ]);

        // $startDateSurabaya = '2025-04-01';
        // $endDateSurabaya = '2025-06-05';

        // InternRegister::create([
        //     'identity_number' => '21.230.0210',
        //     'name' => 'Iwan',
        //     'address' => 'Surabaya',
        //     'school_name' => 'SMK Negeri Surabaya',
        //     'phone_number' => '085150021009',
        //     'email' => 'asep_surabaya@example.com',
        //     'start_date' => $startDateSurabaya,
        //     'end_date' => $endDateSurabaya,
        //     'cover_letter' => 'surat9.docx',
        //     'token' => 'asep_surabayatoken123',
        //     'image' => 'foto9.jpg',
        // ]);
        // InternRegister::create([
        //     'identity_number' => '21.230.0211',
        //     'name' => 'Agus',
        //     'address' => 'Surabaya',
        //     'school_name' => 'SMK Negeri Surabaya',
        //     'phone_number' => '085150021010',
        //     'email' => 'budi_surabaya@example.com',
        //     'start_date' => $startDateSurabaya,
        //     'end_date' => $endDateSurabaya,
        //     'cover_letter' => 'surat10.docx',
        //     'token' => 'budi_surabayatoken456',
        //     'image' => 'foto10.jpg',
        // ]);
        // InternRegister::create([
        //     'identity_number' => '21.230.0212',
        //     'name' => 'Diniyah',
        //     'address' => 'Surabaya',
        //     'school_name' => 'SMK Negeri Surabaya',
        //     'phone_number' => '085150021011',
        //     'email' => 'citra_surabaya@example.com',
        //     'start_date' => $startDateSurabaya,
        //     'end_date' => $endDateSurabaya,
        //     'cover_letter' => 'surat11.docx',
        //     'token' => 'citrasurabayatoken789',
        //     'image' => 'foto11.jpg',
        // ]);
        // InternRegister::create([
        //     'identity_number' => '21.230.0213',
        //     'name' => 'Slamet',
        //     'address' => 'Surabaya',
        //     'school_name' => 'SMK Negeri Surabaya',
        //     'phone_number' => '085150021012',
        //     'email' => 'dian_surabaya@example.com',
        //     'start_date' => $startDateSurabaya,
        //     'end_date' => $endDateSurabaya,
        //     'cover_letter' => 'surat12.docx',
        //     'token' => 'diansurabayatoken101',
        //     'image' => 'foto12.jpg',
        // ]);
        // InternRegister::create([
        //     'identity_number' => '21.230.0313',
        //     'name' => 'Audri',
        //     'address' => 'Surabaya',
        //     'school_name' => 'SMK Negeri Surabaya',
        //     'phone_number' => '085150021012',
        //     'email' => 'dian_surabaya@example.com',
        //     'start_date' => $startDateSurabaya,
        //     'end_date' => $endDateSurabaya,
        //     'cover_letter' => 'surat12.docx',
        //     'token' => 'diansurabayatoken101',
        //     'image' => 'foto12.jpg',
        // ]);
        // InternRegister::create([
        //     'identity_number' => '21.230.0216',
        //     'name' => 'Sekar',
        //     'address' => 'Surabaya',
        //     'school_name' => 'SMK Negeri Surabaya',
        //     'phone_number' => '085150021012',
        //     'email' => 'dian_surabaya@example.com',
        //     'start_date' => $startDateSurabaya,
        //     'end_date' => $endDateSurabaya,
        //     'cover_letter' => 'surat12.docx',
        //     'token' => 'diansurabayatoken101',
        //     'image' => 'foto12.jpg',
        // ]);
    }
}
