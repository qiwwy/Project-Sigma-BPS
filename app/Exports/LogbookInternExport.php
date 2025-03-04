<?php

namespace App\Exports;

use App\Models\LogbookIntern;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;

class LogbookInternExport implements FromCollection, WithHeadings, WithMapping, WithEvents
{
    protected $intern_id;

    public function __construct($intern_id)
    {
        $this->intern_id = $intern_id;
    }

    // Mengambil data dari database
    public function collection()
    {
        return LogbookIntern::where('intern_id', $this->intern_id)
            ->get(['date_logbook', 'intern_id', 'title', 'job_description', 'completion_stat', 'processing_time', 'divisi', 'point']);
    }

    // Header kolom
    public function headings(): array
    {
        return [
            'Tanggal Logbook',
            'Nama Peserta',
            'Judul',
            'Deskripsi',
            'Presentase Pengerjaan',
            'Waktu Pengerjaan',
            'Pemberi Tugas',
            'Nilai'
        ];
    }

    // Mapping data untuk menyesuaikan output
    public function map($logbook): array
    {
        return [
            $logbook->date_logbook,
            $logbook->intern->name ?? 'Belum Diisi',
            $logbook->title ?? 'Belum Diisi',
            $logbook->job_description ?? 'Belum Diisi',
            $logbook->completion_stat ?? 'Belum Diisi',
            $logbook->processing_time ?? 'Belum Diisi',
            $logbook->divisi ?? 'Belum Diisi',
            $logbook->point ?? 'Belum Diisi',
        ];
    }

    // Event untuk styling tampilan Excel
    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $sheet = $event->sheet->getDelegate();

                // Mengatur AutoSize untuk semua kolom (A-H)
                foreach (range('A', 'H') as $column) {
                    $sheet->getColumnDimension($column)->setAutoSize(true);
                }

                // Mengatur gaya pada heading (row pertama)
                $sheet->getStyle('A1:H1')->applyFromArray([
                    'font' => [
                        'bold' => true, // Teks tebal
                    ],
                    'alignment' => [
                        'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER, // Teks rata tengah
                        'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,    // Teks rata tengah vertikal
                    ],
                    'fill' => [
                        'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                        'startColor' => [
                            'argb' => 'FFD700', // Warna kuning terang
                        ],
                    ],
                ]);

                // Mengatur tinggi baris header
                $sheet->getRowDimension(1)->setRowHeight(25);
            },
        ];
    }
}
