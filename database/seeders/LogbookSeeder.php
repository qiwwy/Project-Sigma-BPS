<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\LogbookIntern;

class LogbookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Daftar nilai enum
        $completionStats = ['25', '50', '75', '100'];
        $processingTimes = ['1 Jam', '1 - 3 Jam', '3 - 5 Jam', '5 - 8 Jam'];
        $divisions = ['P3SDI', 'Teknis', 'Sub Bagian Umum'];
        $points = ['100'];

        // Ambil semua record yang memiliki field null
        $logbooks = LogbookIntern::whereNull('completion_stat')
            ->orWhereNull('processing_time')
            ->orWhereNull('divisi')
            ->orWhereNull('title')
            ->orWhereNull('job_description')
            ->orWhereNull('point')
            ->get();

        foreach ($logbooks as $logbook) {
            // Update record yang memiliki field null
            $logbook->update([
                'title' => $logbook->title ?? 'Laporan ' . fake()->sentence(3), // Isi title dengan random sentence
                'job_description' => $logbook->job_description ?? fake()->paragraph(1), // Isi job_description dengan random paragraph
                'completion_stat' => $logbook->completion_stat ?? $completionStats[array_rand($completionStats)],
                'processing_time' => $logbook->processing_time ?? $processingTimes[array_rand($processingTimes)],
                'divisi' => $logbook->divisi ?? $divisions[array_rand($divisions)],
                'point' => $logbook->point ?? $points[array_rand($points)]
            ]);
        }

        echo "Logbook updated successfully.\n";
    }
}
