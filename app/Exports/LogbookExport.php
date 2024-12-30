<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;

class LogbookExport implements FromCollection, WithHeadings, WithMapping, WithEvents
{
    protected $logbooksQuery;

    // Konstruktor menerima query yang difilter dari controller
    public function __construct($logbooksQuery)
    {
        $this->logbooksQuery = $logbooksQuery;
    }

    // Mengambil data logbook yang sudah difilter
    public function collection()
    {
        return $this->logbooksQuery->get();
    }

    // Header untuk kolom di file Excel
    public function headings(): array
    {
        return [
            'Tanggal Logbook',
            'Nama Peserta',
            'Judul Kegiatan',
            'Presentase Pengerjaan',
            'Waktu Dibutuhkan',
            'Tugas Dari',
            'Nilai'
        ];
    }

    // Mapping data untuk kustomisasi output
    public function map($logbook): array
    {
        return [
            $logbook->date_logbook,
            $logbook->intern->name,
            $logbook->title ?: 'Belum Diisi',
            $logbook->completion_stat ?: 'Belum Diisi',
            $logbook->processing_time ?: 'Belum Diisi',
            $logbook->divisi ?: 'Belum Diisi',
            $logbook->point ?: 'Belum Diisi',
        ];
    }

    // Event untuk menyesuaikan tampilan di Excel
    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $sheet = $event->sheet->getDelegate();

                // Mengatur AutoSize untuk semua kolom
                foreach (range('A', 'G') as $column) {
                    $sheet->getColumnDimension($column)->setAutoSize(true);
                }

                // Mengatur gaya pada heading
                $sheet->getStyle('A1:G1')->applyFromArray([
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

                // Meningkatkan tinggi baris heading
                $sheet->getRowDimension(1)->setRowHeight(25);
            },
        ];
    }
}
