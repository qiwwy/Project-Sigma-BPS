<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Interns; // Pastikan model Interns di-import
use App\Models\Presence; // Pastikan model Presence di-import
use Carbon\Carbon; // Untuk manipulasi tanggal

class PresenceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Ambil data intern yang statusnya 'Active' dan division_id tidak null
        $interns = Interns::where('status', 'Active')
            ->whereNotNull('division_id')
            ->get();

        // Jika tidak ada data intern, hentikan seeder
        if ($interns->isEmpty()) {
            $this->command->info('Tidak ada intern dengan status Active dan division_id tidak null.');
            return;
        }

        // Data dummy untuk presence
        $presenceData = [];

        // Loop melalui setiap intern
        foreach ($interns as $intern) {
            // Hitung selisih hari antara start_date dan end_date
            $startDate = Carbon::parse($intern->start_date);
            $endDate = Carbon::parse($intern->end_date);
            $totalDays = $startDate->diffInDays($endDate); // Selisih hari

            // Buat data presence untuk setiap hari antara start_date dan end_date
            for ($i = 0; $i <= $totalDays; $i++) {
                $presenceDate = $startDate->copy()->addDays($i)->toDateString(); // Tanggal kehadiran
                $presenceTime = Carbon::now()->format('H:i:s'); // Waktu kehadiran (default: waktu sekarang)
                $value = $this->getRandomValue(); // Nilai kehadiran (hadir, izin, sakit, alfa)
                $status = $this->getRandomStatus(); // Status (0 atau 1)

                $presenceData[] = [
                    'intern_id' => $intern->id,
                    'presence_date' => $presenceDate,
                    'presence_time' => $presenceTime,
                    'value' => $value,
                    'status' => $status,
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }
        }

        // Insert data ke tabel presence
        Presence::insert($presenceData);

        $this->command->info('Seeder untuk presence berhasil dijalankan.');
    }

    /**
     * Mendapatkan nilai acak untuk field 'value'.
     */
    private function getRandomValue(): string
    {
        $values = ['hadir']; // Pastikan nilai ini sesuai dengan ENUM
        return $values[array_rand($values)];
    }

    /**
     * Mendapatkan status acak untuk field 'status'.
     */
    private function getRandomStatus(): int
    {
        return rand(0, 1); // 0 atau 1
    }
}
